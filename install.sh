echo 'building project'
docker-compose --env-file .env.dev up -d --build
echo 'building database'
docker exec server bash -c "php artisan migrate:fresh --seed"
echo 'project built successfully'