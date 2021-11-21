<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211120090808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(75) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, resource_id INT NOT NULL, content VARCHAR(255) NOT NULL, status ENUM(\'CR\', \'WA\', \'PU\', \'DE\') DEFAULT \'CR\' NOT NULL COMMENT \'(DC2Type:CommentStatusType)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526C89329D25 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, resource_id INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_68C58ED9A76ED395 (user_id), INDEX IDX_68C58ED989329D25 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE progress (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, resource_id INT NOT NULL, status ENUM(\'NS\', \'IP\', \'FI\') DEFAULT \'NS\' NOT NULL COMMENT \'(DC2Type:ProgressStatusType)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_2201F246A76ED395 (user_id), INDEX IDX_2201F24689329D25 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relation_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resource (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, created_by INT NOT NULL, name VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, status ENUM(\'CR\', \'WA\', \'PU\', \'DE\') DEFAULT \'CR\' NOT NULL COMMENT \'(DC2Type:ResourceStatusType)\', resource_type ENUM(\'GA\', \'AR\', \'CH\', \'PC\', \'WO\', \'RS\', \'OG\', \'VI\') NOT NULL COMMENT \'(DC2Type:ResourceType)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_BC91F41612469DE2 (category_id), INDEX IDX_BC91F416DE12AB56 (created_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resource_relation_type (resource_id INT NOT NULL, relation_type_id INT NOT NULL, INDEX IDX_7218726289329D25 (resource_id), INDEX IDX_72187262DC379EE2 (relation_type_id), PRIMARY KEY(resource_id, relation_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(45) NOT NULL, address1 VARCHAR(150) NOT NULL, address2 VARCHAR(150) DEFAULT NULL, postal_code VARCHAR(5) NOT NULL, city VARCHAR(50) NOT NULL, birthday DATETIME NOT NULL, social_situation VARCHAR(45) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C89329D25 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED989329D25 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F246A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F24689329D25 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F41612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F416DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE resource_relation_type ADD CONSTRAINT FK_7218726289329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE resource_relation_type ADD CONSTRAINT FK_72187262DC379EE2 FOREIGN KEY (relation_type_id) REFERENCES relation_type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resource DROP FOREIGN KEY FK_BC91F41612469DE2');
        $this->addSql('ALTER TABLE resource_relation_type DROP FOREIGN KEY FK_72187262DC379EE2');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C89329D25');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED989329D25');
        $this->addSql('ALTER TABLE progress DROP FOREIGN KEY FK_2201F24689329D25');
        $this->addSql('ALTER TABLE resource_relation_type DROP FOREIGN KEY FK_7218726289329D25');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED9A76ED395');
        $this->addSql('ALTER TABLE progress DROP FOREIGN KEY FK_2201F246A76ED395');
        $this->addSql('ALTER TABLE resource DROP FOREIGN KEY FK_BC91F416DE12AB56');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE favorite');
        $this->addSql('DROP TABLE progress');
        $this->addSql('DROP TABLE relation_type');
        $this->addSql('DROP TABLE resource');
        $this->addSql('DROP TABLE resource_relation_type');
        $this->addSql('DROP TABLE user');
    }
}
