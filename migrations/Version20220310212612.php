<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220310212612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quote ADD commercial_id INT DEFAULT NULL, DROP commercial');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF47854071C FOREIGN KEY (commercial_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6B71CBF47854071C ON quote (commercial_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_product CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category_service CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commentary CHANGE comment comment VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE contact CHANGE name name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE message message LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `order` CHANGE quantity quantity VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE total total VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date date VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product CHANGE des des VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reference reference VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE recycling_index recycling_index VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE images images LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF47854071C');
        $this->addSql('DROP INDEX IDX_6B71CBF47854071C ON quote');
        $this->addSql('ALTER TABLE quote ADD commercial VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP commercial_id, CHANGE name_professional name_professional VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE status status VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE total_price total_price VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE numero numero VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE des des VARCHAR(5000) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE societe societe VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE service CHANGE image image VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE des des VARCHAR(1000) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reference reference VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE price price VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE first_name first_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
