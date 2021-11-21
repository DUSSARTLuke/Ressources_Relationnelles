php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

(load peut être à lancer deux fois car non prise en charge du champ unique dans la table user)
