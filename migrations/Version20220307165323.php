<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307165323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, particulier_id INT DEFAULT NULL, quantity VARCHAR(255) NOT NULL, total VARCHAR(255) NOT NULL, INDEX IDX_F5299398A89E0E67 (particulier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A89E0E67 FOREIGN KEY (particulier_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE order_product_product');
        $this->addSql('ALTER TABLE order_product MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64C3A3BB');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6A89E0E67');
        $this->addSql('DROP INDEX IDX_2530ADE6A89E0E67 ON order_product');
        $this->addSql('DROP INDEX UNIQ_2530ADE64C3A3BB ON order_product');
        $this->addSql('ALTER TABLE order_product DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE order_product ADD order_id INT NOT NULL, ADD product_id INT NOT NULL, DROP id, DROP particulier_id, DROP payment_id, DROP date_order, DROP quantity_product');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE68D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_2530ADE68D9F6D38 ON order_product (order_id)');
        $this->addSql('CREATE INDEX IDX_2530ADE64584665A ON order_product (product_id)');
        $this->addSql('ALTER TABLE order_product ADD PRIMARY KEY (order_id, product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE68D9F6D38');
        $this->addSql('CREATE TABLE order_product_product (order_product_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_C99ADC41F65E9B0F (order_product_id), INDEX IDX_C99ADC414584665A (product_id), PRIMARY KEY(order_product_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE order_product_product ADD CONSTRAINT FK_C99ADC414584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product_product ADD CONSTRAINT FK_C99ADC41F65E9B0F FOREIGN KEY (order_product_id) REFERENCES order_product (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('ALTER TABLE card CHANGE number_card number_card VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name_card name_card VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE card_type CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category_product CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category_service CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commentary CHANGE comment comment VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('DROP INDEX IDX_2530ADE68D9F6D38 ON order_product');
        $this->addSql('DROP INDEX IDX_2530ADE64584665A ON order_product');
        $this->addSql('ALTER TABLE order_product ADD id INT AUTO_INCREMENT NOT NULL, ADD particulier_id INT NOT NULL, ADD payment_id INT NOT NULL, ADD date_order DATE NOT NULL, ADD quantity_product VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP order_id, DROP product_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6A89E0E67 FOREIGN KEY (particulier_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2530ADE6A89E0E67 ON order_product (particulier_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2530ADE64C3A3BB ON order_product (payment_id)');
        $this->addSql('ALTER TABLE payment CHANGE first_name first_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adress adress VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE des des VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE total_price total_price VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product CHANGE image image VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE des des VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reference reference VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE price price VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE quantity quantity VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE recycling_index recycling_index VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE quote CHANGE name_professional name_professional VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE total_price total_price VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE service CHANGE image image VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE des des VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reference reference VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE price price VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE first_name first_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
