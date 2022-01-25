<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125134419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE favorite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE progress_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE relation_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE resource_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(75) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, user_id INT NOT NULL, resource_id INT NOT NULL, content VARCHAR(255) NOT NULL, status VARCHAR(255) CHECK(status IN (\'CR\', \'WA\', \'PU\', \'DE\')) DEFAULT \'CR\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('CREATE INDEX IDX_9474526C89329D25 ON comment (resource_id)');
        $this->addSql('COMMENT ON COLUMN comment.status IS \'(DC2Type:CommentStatusType)\'');
        $this->addSql('CREATE TABLE favorite (id INT NOT NULL, user_id INT NOT NULL, resource_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_68C58ED9A76ED395 ON favorite (user_id)');
        $this->addSql('CREATE INDEX IDX_68C58ED989329D25 ON favorite (resource_id)');
        $this->addSql('CREATE TABLE progress (id INT NOT NULL, user_id INT NOT NULL, resource_id INT NOT NULL, status VARCHAR(255) CHECK(status IN (\'NS\', \'IP\', \'FI\')) DEFAULT \'NS\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2201F246A76ED395 ON progress (user_id)');
        $this->addSql('CREATE INDEX IDX_2201F24689329D25 ON progress (resource_id)');
        $this->addSql('COMMENT ON COLUMN progress.status IS \'(DC2Type:ProgressStatusType)\'');
        $this->addSql('CREATE TABLE relation_type (id INT NOT NULL, name VARCHAR(80) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE resource (id INT NOT NULL, category_id INT NOT NULL, created_by INT NOT NULL, name VARCHAR(255) NOT NULL, content TEXT NOT NULL, status VARCHAR(255) CHECK(status IN (\'CR\', \'WA\', \'PU\', \'DE\')) DEFAULT \'CR\' NOT NULL, resource_type VARCHAR(255) CHECK(resource_type IN (\'GA\', \'AR\', \'CH\', \'PC\', \'WO\', \'RS\', \'OG\', \'VI\')) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BC91F41612469DE2 ON resource (category_id)');
        $this->addSql('CREATE INDEX IDX_BC91F416DE12AB56 ON resource (created_by)');
        $this->addSql('COMMENT ON COLUMN resource.status IS \'(DC2Type:ResourceStatusType)\'');
        $this->addSql('COMMENT ON COLUMN resource.resource_type IS \'(DC2Type:ResourceType)\'');
        $this->addSql('CREATE TABLE resource_relation_type (resource_id INT NOT NULL, relation_type_id INT NOT NULL, PRIMARY KEY(resource_id, relation_type_id))');
        $this->addSql('CREATE INDEX IDX_7218726289329D25 ON resource_relation_type (resource_id)');
        $this->addSql('CREATE INDEX IDX_72187262DC379EE2 ON resource_relation_type (relation_type_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(45) NOT NULL, address1 VARCHAR(150) NOT NULL, address2 VARCHAR(150) DEFAULT NULL, postal_code VARCHAR(5) NOT NULL, city VARCHAR(50) NOT NULL, birthday TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, social_situation VARCHAR(45) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C89329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED989329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F246A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F24689329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F41612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F416DE12AB56 FOREIGN KEY (created_by) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resource_relation_type ADD CONSTRAINT FK_7218726289329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resource_relation_type ADD CONSTRAINT FK_72187262DC379EE2 FOREIGN KEY (relation_type_id) REFERENCES relation_type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE resource DROP CONSTRAINT FK_BC91F41612469DE2');
        $this->addSql('ALTER TABLE resource_relation_type DROP CONSTRAINT FK_72187262DC379EE2');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C89329D25');
        $this->addSql('ALTER TABLE favorite DROP CONSTRAINT FK_68C58ED989329D25');
        $this->addSql('ALTER TABLE progress DROP CONSTRAINT FK_2201F24689329D25');
        $this->addSql('ALTER TABLE resource_relation_type DROP CONSTRAINT FK_7218726289329D25');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE favorite DROP CONSTRAINT FK_68C58ED9A76ED395');
        $this->addSql('ALTER TABLE progress DROP CONSTRAINT FK_2201F246A76ED395');
        $this->addSql('ALTER TABLE resource DROP CONSTRAINT FK_BC91F416DE12AB56');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE favorite_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE progress_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE relation_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE resource_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE favorite');
        $this->addSql('DROP TABLE progress');
        $this->addSql('DROP TABLE relation_type');
        $this->addSql('DROP TABLE resource');
        $this->addSql('DROP TABLE resource_relation_type');
        $this->addSql('DROP TABLE "user"');
    }
}
