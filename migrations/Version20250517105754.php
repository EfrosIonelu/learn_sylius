<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250517105754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE app_customer (id INT AUTO_INCREMENT NOT NULL, customer_group_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, birthday DATETIME DEFAULT NULL, gender VARCHAR(1) DEFAULT 'u' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, subscribed_to_newsletter TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_89B9EEA4E7927C74 (email), UNIQUE INDEX UNIQ_89B9EEA4A0D96FBF (email_canonical), INDEX IDX_89B9EEA4D2919A68 (customer_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE app_customer_group (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7C0FA30077153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE app_user (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, username_canonical VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) NOT NULL, password VARCHAR(255) DEFAULT NULL, last_login DATETIME DEFAULT NULL, password_reset_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, email_verification_token VARCHAR(255) DEFAULT NULL, verified_at DATETIME DEFAULT NULL, roles JSON NOT NULL, email VARCHAR(255) DEFAULT NULL, email_canonical VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_88BDF3E96B7BA4B6 (password_reset_token), UNIQUE INDEX UNIQ_88BDF3E9C4995C67 (email_verification_token), UNIQUE INDEX UNIQ_88BDF3E99395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE app_user_oauth (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, provider VARCHAR(255) NOT NULL, identifier VARCHAR(255) NOT NULL, access_token TEXT DEFAULT NULL, refresh_token TEXT DEFAULT NULL, INDEX IDX_B00328E0A76ED395 (user_id), UNIQUE INDEX user_provider (user_id, provider), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE sylius_rbac_administration_role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, permissions JSON NOT NULL, UNIQUE INDEX UNIQ_3333A12E5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE app_customer ADD CONSTRAINT FK_89B9EEA4D2919A68 FOREIGN KEY (customer_group_id) REFERENCES app_customer_group (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE app_user ADD CONSTRAINT FK_88BDF3E99395C3F3 FOREIGN KEY (customer_id) REFERENCES app_customer (id) ON DELETE SET NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE app_user_oauth ADD CONSTRAINT FK_B00328E0A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE app_customer DROP FOREIGN KEY FK_89B9EEA4D2919A68
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE app_user DROP FOREIGN KEY FK_88BDF3E99395C3F3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE app_user_oauth DROP FOREIGN KEY FK_B00328E0A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE app_customer
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE app_customer_group
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE app_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE app_user_oauth
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE sylius_rbac_administration_role
        SQL);
    }
}
