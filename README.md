
`echo "127.0.0.1 contacts.local" >> /etc/hosts`

`docker-compose up`

`docker exec -i $(docker container ls -q -f "name=contacts_php") php artisan migrate`

