<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307133346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, card_type_id INT NOT NULL, particulier_id INT NOT NULL, number_card VARCHAR(50) NOT NULL, name_card VARCHAR(50) NOT NULL, expiration_date DATE NOT NULL, INDEX IDX_161498D3925606E5 (card_type_id), INDEX IDX_161498D3A89E0E67 (particulier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentary (id INT AUTO_INCREMENT NOT NULL, particulier_id INT NOT NULL, product_id INT NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_1CAC12CAA89E0E67 (particulier_id), INDEX IDX_1CAC12CA4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, last_name VARCHAR(30) NOT NULL, mail VARCHAR(50) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product (id INT AUTO_INCREMENT NOT NULL, particulier_id INT NOT NULL, payment_id INT NOT NULL, date_order DATE NOT NULL, quantity_product VARCHAR(50) NOT NULL, INDEX IDX_2530ADE6A89E0E67 (particulier_id), UNIQUE INDEX UNIQ_2530ADE64C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product_product (order_product_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_C99ADC41F65E9B0F (order_product_id), INDEX IDX_C99ADC414584665A (product_id), PRIMARY KEY(order_product_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, tel VARCHAR(50) NOT NULL, country VARCHAR(50) NOT NULL, city VARCHAR(50) NOT NULL, cp VARCHAR(50) NOT NULL, adress VARCHAR(50) NOT NULL, des VARCHAR(255) NOT NULL, total_price VARCHAR(50) NOT NULL, INDEX IDX_6D28840D4ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_product (payment_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_CA030A474C3A3BB (payment_id), INDEX IDX_CA030A474584665A (product_id), PRIMARY KEY(payment_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_product_id INT NOT NULL, des VARCHAR(255) NOT NULL, reference VARCHAR(50) NOT NULL, price VARCHAR(50) NOT NULL, quantity VARCHAR(50) NOT NULL, state TINYINT(1) NOT NULL, recycling_index VARCHAR(50) NOT NULL, name VARCHAR(30) NOT NULL, images LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_D34A04AD639A3624 (category_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote (id INT AUTO_INCREMENT NOT NULL, commercial_id INT DEFAULT NULL, name_professional VARCHAR(50) NOT NULL, status TINYINT(1) NOT NULL, date_quote DATE NOT NULL, total_price VARCHAR(50) NOT NULL, INDEX IDX_6B71CBF47854071C (commercial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote_service (quote_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_E723256DB805178 (quote_id), INDEX IDX_E723256ED5CA9E6 (service_id), PRIMARY KEY(quote_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, category_service_id INT NOT NULL, image VARCHAR(50) NOT NULL, des VARCHAR(50) NOT NULL, reference VARCHAR(50) NOT NULL, price VARCHAR(50) NOT NULL, state TINYINT(1) NOT NULL, INDEX IDX_E19D9AD2CB42F998 (category_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3925606E5 FOREIGN KEY (card_type_id) REFERENCES card_type (id)');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3A89E0E67 FOREIGN KEY (particulier_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CAA89E0E67 FOREIGN KEY (particulier_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CA4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6A89E0E67 FOREIGN KEY (particulier_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE order_product_product ADD CONSTRAINT FK_C99ADC41F65E9B0F FOREIGN KEY (order_product_id) REFERENCES order_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product_product ADD CONSTRAINT FK_C99ADC414584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE payment_product ADD CONSTRAINT FK_CA030A474C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_product ADD CONSTRAINT FK_CA030A474584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD639A3624 FOREIGN KEY (category_product_id) REFERENCES category_product (id)');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF47854071C FOREIGN KEY (commercial_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quote_service ADD CONSTRAINT FK_E723256DB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quote_service ADD CONSTRAINT FK_E723256ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2CB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D4ACC9A20');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3925606E5');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD639A3624');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2CB42F998');
        $this->addSql('ALTER TABLE order_product_product DROP FOREIGN KEY FK_C99ADC41F65E9B0F');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64C3A3BB');
        $this->addSql('ALTER TABLE payment_product DROP FOREIGN KEY FK_CA030A474C3A3BB');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CA4584665A');
        $this->addSql('ALTER TABLE order_product_product DROP FOREIGN KEY FK_C99ADC414584665A');
        $this->addSql('ALTER TABLE payment_product DROP FOREIGN KEY FK_CA030A474584665A');
        $this->addSql('ALTER TABLE quote_service DROP FOREIGN KEY FK_E723256DB805178');
        $this->addSql('ALTER TABLE quote_service DROP FOREIGN KEY FK_E723256ED5CA9E6');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3A89E0E67');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CAA89E0E67');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6A89E0E67');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF47854071C');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE card_type');
        $this->addSql('DROP TABLE category_product');
        $this->addSql('DROP TABLE category_service');
        $this->addSql('DROP TABLE commentary');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE order_product_product');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_product');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE quote_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
    }
}
