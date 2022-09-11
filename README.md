### Setup and Installation

1. git clone https://github.com/RHBW174368/kevin_pgphptest.git
2. cd kevin_pgphptest
3. composer update
4. copy contents of .env_dev to create .env
5. modify .env change database name "pgphp_db"
6. php artisan config:clear
7. php artisan cache:clear

### Migrating DB and Seeder

8. php artisan migrate:fresh --seed

### Run Unit Testing 

9. php artisan test 

### Run Server on Local Machine

10. php artisan server --host=localhost --port=<your port> (Or Any Port Available)

### Testing via POSTMAN 

11. GET Method
    url: http://localhost:<your port>/api/users_comments/1 (Change ID for Testing)
    
12. POST Method (Form-Data)
    url: http://localhost:<your port>/api/users_comments/
    Request Body
        form-data:
            id => 1
            password => 720DF6C2482218518FA20FDC52D4DED7ECC043AB
            comments => "POST_Form_Comment"
        
13. POST Method (Raw JSON)
    url: http://localhost:<your port>/api/users_comments
    Request Body
        content-type: application/json
        raw: {"id":"1","password":"720DF6C2482218518FA20FDC52D4DED7ECC043AB","comments":"POST_JSONComment"}
    
14. POST Method (CLI Command)
    php artisan update_user:comment <id> <comments> <password optional>
    php artisan update_user:comment 1 POST_CLIComment

