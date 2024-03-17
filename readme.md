# Task Assigner

## Stack

* **Laravel**
* **Nginx**
* **Redis**
* **MySQL**
* **Docker**
* **Supervisor**

### Kurulum Gereksinimleri
- Docker

### Kurulum
```
  chmod +x install.sh && ./install.sh
```

### Nasıl çalışır ?
Aşağıdaki komut vasıtası ile container içine giriniz
```
docker-compose --env-file .env.dev exec server bash
```
Mock data çekmek için aşağıdaki komutlardan birini çalıştırabilirsiniz.
```
php artisan fetch:task trello
php artisan fetch:task jira
```

Yukarıdaki komutlardan bir tanesini çalıştırdığınızda laravel horizon workerları jobları eritmeye başlayacak.

http://localhost adresini ziyaret ederek optimize edilmiş task assignmentlarını görebilirsiniz.
