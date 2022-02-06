<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220206200428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_product (id INT AUTO_INCREMENT NOT NULL, payment_id INT DEFAULT NULL, particulier_id INT DEFAULT NULL, date_order DATE NOT NULL, quantity_product VARCHAR(255) NOT NULL, total_price VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_2530ADE64C3A3BB (payment_id), INDEX IDX_2530ADE6A89E0E67 (particulier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product_product (order_product_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_C99ADC41F65E9B0F (order_product_id), INDEX IDX_C99ADC414584665A (product_id), PRIMARY KEY(order_product_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE particulier (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, mail VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, tel VARCHAR(11) NOT NULL, city VARCHAR(50) NOT NULL, cp VARCHAR(7) NOT NULL, adress VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, category_service_id INT DEFAULT NULL, image VARCHAR(50) NOT NULL, des VARCHAR(255) NOT NULL, reference VARCHAR(50) NOT NULL, price VARCHAR(50) NOT NULL, state TINYINT(1) NOT NULL, INDEX IDX_E19D9AD2CB42F998 (category_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6A89E0E67 FOREIGN KEY (particulier_id) REFERENCES particulier (id)');
        $this->addSql('ALTER TABLE order_product_product ADD CONSTRAINT FK_C99ADC41F65E9B0F FOREIGN KEY (order_product_id) REFERENCES order_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product_product ADD CONSTRAINT FK_C99ADC414584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2CB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_product_product DROP FOREIGN KEY FK_C99ADC41F65E9B0F');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6A89E0E67');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE order_product_product');
        $this->addSql('DROP TABLE particulier');
        $this->addSql('DROP TABLE service');
        $this->addSql('ALTER TABLE admin CHANGE first_name first_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE card CHANGE number_card number_card VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name_card name_card VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE card_type CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category_product CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category_service CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commentary CHANGE comment comment VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commercial CHANGE first_name first_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE payment CHANGE first_name first_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel VARCHAR(11) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp VARCHAR(6) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE des des VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE total_price total_price VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product CHANGE image image VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE des des VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ref ref VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE price price VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE quantity quantity VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE recycling_index recycling_index VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE quote CHANGE name_professional name_professional VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE total_price total_price VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
