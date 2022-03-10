<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<< HEAD:migrations/Version20220310133257.php
final class Version20220310133257 extends AbstractMigration
=======
final class Version20220310105544 extends AbstractMigration
>>>>>>> Ikrame:migrations/Version20220310105544.php
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentary (id INT AUTO_INCREMENT NOT NULL, particulier_id INT NOT NULL, product_id INT NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_1CAC12CAA89E0E67 (particulier_id), INDEX IDX_1CAC12CA4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, last_name VARCHAR(30) NOT NULL, mail VARCHAR(50) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, particulier_id INT DEFAULT NULL, quantity VARCHAR(255) NOT NULL, total VARCHAR(255) NOT NULL, date VARCHAR(50) NOT NULL, INDEX IDX_F5299398A89E0E67 (particulier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product (order_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_2530ADE68D9F6D38 (order_id), INDEX IDX_2530ADE64584665A (product_id), PRIMARY KEY(order_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_product_id INT NOT NULL, des VARCHAR(255) NOT NULL, reference VARCHAR(50) NOT NULL, state TINYINT(1) NOT NULL, recycling_index VARCHAR(50) NOT NULL, name VARCHAR(30) NOT NULL, images LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', price NUMERIC(10, 2) NOT NULL, quantity NUMERIC(10, 0) NOT NULL, INDEX IDX_D34A04AD639A3624 (category_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote (id INT AUTO_INCREMENT NOT NULL, name_professional VARCHAR(50) NOT NULL, status VARCHAR(30) NOT NULL, date_quote DATE NOT NULL, total_price VARCHAR(50) NOT NULL, commercial VARCHAR(255) DEFAULT NULL, mail VARCHAR(50) NOT NULL, numero VARCHAR(10) NOT NULL, city VARCHAR(50) NOT NULL, des VARCHAR(5000) NOT NULL, societe VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote_service (quote_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_E723256DB805178 (quote_id), INDEX IDX_E723256ED5CA9E6 (service_id), PRIMARY KEY(quote_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, category_service_id INT NOT NULL, image VARCHAR(100) NOT NULL, des VARCHAR(1000) NOT NULL, reference VARCHAR(50) NOT NULL, price VARCHAR(50) NOT NULL, state TINYINT(1) NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_E19D9AD2CB42F998 (category_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, date_create DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CAA89E0E67 FOREIGN KEY (particulier_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CA4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A89E0E67 FOREIGN KEY (particulier_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE68D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD639A3624 FOREIGN KEY (category_product_id) REFERENCES category_product (id)');
        $this->addSql('ALTER TABLE quote_service ADD CONSTRAINT FK_E723256DB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quote_service ADD CONSTRAINT FK_E723256ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2CB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD639A3624');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2CB42F998');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE68D9F6D38');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CA4584665A');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('ALTER TABLE quote_service DROP FOREIGN KEY FK_E723256DB805178');
        $this->addSql('ALTER TABLE quote_service DROP FOREIGN KEY FK_E723256ED5CA9E6');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CAA89E0E67');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A89E0E67');
        $this->addSql('DROP TABLE category_product');
        $this->addSql('DROP TABLE category_service');
        $this->addSql('DROP TABLE commentary');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE quote_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
    }
}
