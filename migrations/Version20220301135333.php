<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301135333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD parent_id INT DEFAULT NULL, CHANGE status status ENUM(\'CR\', \'WA\', \'PU\', \'DE\') DEFAULT \'CR\' NOT NULL COMMENT \'(DC2Type:CommentStatusType)\'');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C727ACA70 FOREIGN KEY (parent_id) REFERENCES comment (id)');
        $this->addSql('CREATE INDEX IDX_9474526C727ACA70 ON comment (parent_id)');
        $this->addSql('ALTER TABLE progress CHANGE status status ENUM(\'NS\', \'IP\', \'FI\') DEFAULT \'NS\' NOT NULL COMMENT \'(DC2Type:ProgressStatusType)\'');
        $this->addSql('ALTER TABLE resource CHANGE status status ENUM(\'CR\', \'WA\', \'PU\', \'DE\') DEFAULT \'CR\' NOT NULL COMMENT \'(DC2Type:ResourceStatusType)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C727ACA70');
        $this->addSql('DROP INDEX IDX_9474526C727ACA70 ON comment');
        $this->addSql('ALTER TABLE comment DROP parent_id, CHANGE status status ENUM(\'CR\', \'WA\', \'PU\', \'DE\') DEFAULT \'CR\' CHARACTER SET utf8mb4 DEFAULT \'CR\' NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:CommentStatusType)\'');
        $this->addSql('ALTER TABLE progress CHANGE status status ENUM(\'NS\', \'IP\', \'FI\') DEFAULT \'NS\' CHARACTER SET utf8mb4 DEFAULT \'NS\' NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:ProgressStatusType)\'');
        $this->addSql('ALTER TABLE resource CHANGE status status ENUM(\'CR\', \'WA\', \'PU\', \'DE\') DEFAULT \'CR\' CHARACTER SET utf8mb4 DEFAULT \'CR\' NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:ResourceStatusType)\'');
    }
}
