<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250604172549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE app_customer ADD media_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE app_customer ADD CONSTRAINT FK_89B9EEA4EA9FDD75 FOREIGN KEY (media_id) REFERENCES app_cms_media (id) ON DELETE SET NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_89B9EEA4EA9FDD75 ON app_customer (media_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE app_customer DROP FOREIGN KEY FK_89B9EEA4EA9FDD75
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_89B9EEA4EA9FDD75 ON app_customer
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE app_customer DROP media_id
        SQL);
    }
}
