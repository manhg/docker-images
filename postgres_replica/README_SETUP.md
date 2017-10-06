Replication major steps

* This is set for
    - Async wal-based
    - Over SSL between master-standby Postgres nodes
    - No automatic failover

* Setup hostnames, network firewall, ufw

* Create replication user

```sql
CREATE ROLE replica WITH REPLICATION PASSWORD 'your_password' LOGIN
```

* Generate SSL keys and enable secure connection

* Setup master config

```
# added to postgresql.conf
listen_addresses = 'localhost,master_ip'

# To enable read-only queries on a standby server, wal_level must be set to
# "hot_standby". But you can choose "archive" if you never connect to the
# server in standby mode.
wal_level = hot_standby

# Set the maximum number of concurrent connections from the standby servers.
max_wal_senders = 5

# To prevent the primary server from removing the WAL segments required for
# the standby server before shipping them, set the minimum number of segments
# retained in the pg_wal directory. At least wal_keep_segments should be
# larger than the number of segments generated between the beginning of
# online-backup and the startup of streaming replication. If you enable WAL
# archiving to an archive directory accessible from the standby, this may
# not be necessary.
wal_keep_segments = 32

# Enable WAL archiving on the primary to an archive directory accessible from
# the standby. If wal_keep_segments is a high enough number to retain the WAL
# segments required for the standby server, this is not necessary.
archive_mode    = on
archive_command = 'cp %p /path_to/archive/%f'

# added to pg_hba.conf
host  replication     replication     192.168.0.20/32         md5
```


Verify config and reload
```sql
SELECT pg_reload_conf()
```

* Copy base data from master -> standbys

```

```
* Setup slave (standby) config

```sh
pg_basebackup -h master_ip -D /path/to/pg_data -R -P -U replica --wal-method=stream
```

Edit `recovery.conf` (must be in pgdata path), pg_basebackup might already create it for you

```
standby_mode          = 'on'  t
primary_conninfo      = 'host=master_ip port=5432 user=replica password=your_password sslmode=require'


# Specifies a trigger file whose presence should cause streaming replication to
# end (i.e., failover).
trigger_file = '/path_to/trigger'

# Specifies a command to load archive segments from the WAL archive. If
# wal_keep_segments is a high enough number to retain the WAL segments
# required for the standby server, this may not be necessary. But
# a large workload can cause segments to be recycled before the standby
# is fully synchronized, requiring you to start again from a new base backup.
restore_command = 'cp /path_to/archive/%f "%p"'
```

* Verify everything works!

```
# on master
ps -ef | grep 'wal sender'

# on slave
ps -ef | grep 'wal receiver'
```

```sql
SELECT * FROM pg_stat_ssl;
```

References:
https://wiki.postgresql.org/wiki/Streaming_Replication

Fully mentioned:
https://www.postgresql.org/docs/current/static/warm-standby.html