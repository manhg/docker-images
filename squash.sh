function docker-squash-grep {
    image_ids=$(docker images | awk /$1/ | awk '{ print $3 }')
    for image_id in $image_ids
    do
        echo "$image_id\n"
        docker save $image_id | docker-squash -verbose | docker load
    done
}