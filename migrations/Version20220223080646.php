<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223080646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE status status ENUM(\'CR\', \'WA\', \'PU\', \'DE\') DEFAULT \'CR\' NOT NULL COMMENT \'(DC2Type:CommentStatusType)\'');
        $this->addSql('ALTER TABLE progress CHANGE status status ENUM(\'NS\', \'IP\', \'FI\') DEFAULT \'NS\' NOT NULL COMMENT \'(DC2Type:ProgressStatusType)\'');
        $this->addSql('ALTER TABLE resource CHANGE status status ENUM(\'CR\', \'WA\', \'PU\', \'DE\') DEFAULT \'CR\' NOT NULL COMMENT \'(DC2Type:ResourceStatusType)\'');
        $this->addSql('ALTER TABLE user ADD conf_password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE status status ENUM(\'CR\', \'WA\', \'PU\', \'DE\') DEFAULT \'CR\' CHARACTER SET utf8mb4 DEFAULT \'CR\' NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:CommentStatusType)\'');
        $this->addSql('ALTER TABLE progress CHANGE status status ENUM(\'NS\', \'IP\', \'FI\') DEFAULT \'NS\' CHARACTER SET utf8mb4 DEFAULT \'NS\' NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:ProgressStatusType)\'');
        $this->addSql('ALTER TABLE resource CHANGE status status ENUM(\'CR\', \'WA\', \'PU\', \'DE\') DEFAULT \'CR\' CHARACTER SET utf8mb4 DEFAULT \'CR\' NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:ResourceStatusType)\'');
        $this->addSql('ALTER TABLE `user` DROP conf_password');
    }
}
