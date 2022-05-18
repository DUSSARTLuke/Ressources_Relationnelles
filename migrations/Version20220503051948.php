<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503051948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE resource_id resource_id INT NOT NULL, CHANGE status status ENUM(\'WA\', \'PU\', \'DE\') DEFAULT \'WA\' NOT NULL COMMENT \'(DC2Type:CommentStatusType)\'');
        $this->addSql('ALTER TABLE progress CHANGE status status ENUM(\'NS\', \'IP\', \'FI\') DEFAULT \'NS\' NOT NULL COMMENT \'(DC2Type:ProgressStatusType)\'');
        $this->addSql('ALTER TABLE resource CHANGE status status ENUM(\'WA\', \'PU\', \'SU\', \'DE\') DEFAULT \'WA\' NOT NULL COMMENT \'(DC2Type:ResourceStatusType)\', CHANGE visibility visibility ENUM(\'PUB\', \'PRI\', \'SH\') DEFAULT \'PUB\' NOT NULL COMMENT \'(DC2Type:ResourceVisibilityType)\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE resource_id resource_id INT DEFAULT NULL, CHANGE status status ENUM(\'WA\', \'PU\', \'DE\') DEFAULT \'WA\' DEFAULT \'WA\' NOT NULL COMMENT \'(DC2Type:CommentStatusType)\'');
        $this->addSql('ALTER TABLE progress CHANGE status status ENUM(\'NS\', \'IP\', \'FI\') DEFAULT \'NS\' DEFAULT \'NS\' NOT NULL COMMENT \'(DC2Type:ProgressStatusType)\'');
        $this->addSql('ALTER TABLE resource CHANGE status status ENUM(\'WA\', \'PU\', \'SU\', \'DE\') DEFAULT \'WA\' DEFAULT \'WA\' NOT NULL COMMENT \'(DC2Type:ResourceStatusType)\', CHANGE visibility visibility ENUM(\'PUB\', \'PRI\', \'SH\') DEFAULT \'PUB\' DEFAULT \'PUB\' NOT NULL COMMENT \'(DC2Type:ResourceVisibilityType)\'');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
