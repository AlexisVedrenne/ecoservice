<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220215181902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3CC3D5E73');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6CC3D5E73');
        $this->addSql('CREATE TABLE category_service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, tel VARCHAR(50) NOT NULL, country VARCHAR(50) NOT NULL, city VARCHAR(50) NOT NULL, cp VARCHAR(50) NOT NULL, adress VARCHAR(50) NOT NULL, des VARCHAR(255) NOT NULL, total_price VARCHAR(50) NOT NULL, INDEX IDX_6D28840D4ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_product (payment_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_CA030A474C3A3BB (payment_id), INDEX IDX_CA030A474584665A (product_id), PRIMARY KEY(payment_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote (id INT AUTO_INCREMENT NOT NULL, commercial_id INT DEFAULT NULL, name_professional VARCHAR(50) NOT NULL, status TINYINT(1) NOT NULL, date_quote DATE NOT NULL, total_price VARCHAR(50) NOT NULL, INDEX IDX_6B71CBF47854071C (commercial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote_service (quote_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_E723256DB805178 (quote_id), INDEX IDX_E723256ED5CA9E6 (service_id), PRIMARY KEY(quote_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, category_service_id INT NOT NULL, image VARCHAR(50) NOT NULL, des VARCHAR(50) NOT NULL, reference VARCHAR(50) NOT NULL, price VARCHAR(50) NOT NULL, state TINYINT(1) NOT NULL, INDEX IDX_E19D9AD2CB42F998 (category_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE payment_product ADD CONSTRAINT FK_CA030A474C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_product ADD CONSTRAINT FK_CA030A474584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF47854071C FOREIGN KEY (commercial_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quote_service ADD CONSTRAINT FK_E723256DB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quote_service ADD CONSTRAINT FK_E723256ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2CB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id)');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE particular');
        $this->addSql('DROP INDEX IDX_161498D3CC3D5E73 ON card');
        $this->addSql('ALTER TABLE card ADD particulier_id INT NOT NULL, ADD expiration_date DATE NOT NULL, DROP card_type, CHANGE number_card number_card VARCHAR(50) NOT NULL, CHANGE name_card name_card VARCHAR(50) NOT NULL, CHANGE particular_id card_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3925606E5 FOREIGN KEY (card_type_id) REFERENCES card_type (id)');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3A89E0E67 FOREIGN KEY (particulier_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_161498D3925606E5 ON card (card_type_id)');
        $this->addSql('CREATE INDEX IDX_161498D3A89E0E67 ON card (particulier_id)');
        $this->addSql('ALTER TABLE card_type CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE category_product DROP FOREIGN KEY FK_149244D3BE6903FD');
        $this->addSql('DROP INDEX IDX_149244D3BE6903FD ON category_product');
        $this->addSql('ALTER TABLE category_product DROP product_category_id, CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE commentary ADD particulier_id INT NOT NULL, ADD product_id INT NOT NULL, DROP particular, CHANGE comment comment VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CAA89E0E67 FOREIGN KEY (particulier_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CA4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_1CAC12CAA89E0E67 ON commentary (particulier_id)');
        $this->addSql('CREATE INDEX IDX_1CAC12CA4584665A ON commentary (product_id)');
        $this->addSql('DROP INDEX IDX_2530ADE6CC3D5E73 ON order_product');
        $this->addSql('ALTER TABLE order_product ADD particulier_id INT NOT NULL, ADD payment_id INT NOT NULL, DROP particular_id, DROP total_price, CHANGE date_order date_order DATE NOT NULL, CHANGE quantity_product quantity_product VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6A89E0E67 FOREIGN KEY (particulier_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('CREATE INDEX IDX_2530ADE6A89E0E67 ON order_product (particulier_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2530ADE64C3A3BB ON order_product (payment_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD63379586');
        $this->addSql('DROP INDEX IDX_D34A04AD63379586 ON product');
        $this->addSql('ALTER TABLE product ADD category_product_id INT NOT NULL, DROP comments_id, CHANGE image image VARCHAR(50) NOT NULL, CHANGE reference reference VARCHAR(50) NOT NULL, CHANGE price price VARCHAR(50) NOT NULL, CHANGE quantity quantity VARCHAR(50) NOT NULL, CHANGE state state TINYINT(1) NOT NULL, CHANGE recycling_index recycling_index VARCHAR(50) NOT NULL, CHANGE description des VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD639A3624 FOREIGN KEY (category_product_id) REFERENCES category_product (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD639A3624 ON product (category_product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2CB42F998');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64C3A3BB');
        $this->addSql('ALTER TABLE payment_product DROP FOREIGN KEY FK_CA030A474C3A3BB');
        $this->addSql('ALTER TABLE quote_service DROP FOREIGN KEY FK_E723256DB805178');
        $this->addSql('ALTER TABLE quote_service DROP FOREIGN KEY FK_E723256ED5CA9E6');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3A89E0E67');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CAA89E0E67');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6A89E0E67');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF47854071C');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mail VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE particular (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, fist_name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, city VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, zip_code VARCHAR(5) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adress VARCHAR(70) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE category_service');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_product');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE quote_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3925606E5');
        $this->addSql('DROP INDEX IDX_161498D3925606E5 ON card');
        $this->addSql('DROP INDEX IDX_161498D3A89E0E67 ON card');
        $this->addSql('ALTER TABLE card ADD particular_id INT NOT NULL, ADD card_type VARCHAR(25) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP card_type_id, DROP particulier_id, DROP expiration_date, CHANGE number_card number_card VARCHAR(16) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name_card name_card VARCHAR(25) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3CC3D5E73 FOREIGN KEY (particular_id) REFERENCES particular (id)');
        $this->addSql('CREATE INDEX IDX_161498D3CC3D5E73 ON card (particular_id)');
        $this->addSql('ALTER TABLE card_type CHANGE name name VARCHAR(25) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category_product ADD product_category_id INT DEFAULT NULL, CHANGE name name VARCHAR(25) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category_product ADD CONSTRAINT FK_149244D3BE6903FD FOREIGN KEY (product_category_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_149244D3BE6903FD ON category_product (product_category_id)');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CA4584665A');
        $this->addSql('DROP INDEX IDX_1CAC12CAA89E0E67 ON commentary');
        $this->addSql('DROP INDEX IDX_1CAC12CA4584665A ON commentary');
        $this->addSql('ALTER TABLE commentary ADD particular VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP particulier_id, DROP product_id, CHANGE comment comment LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_2530ADE6A89E0E67 ON order_product');
        $this->addSql('DROP INDEX UNIQ_2530ADE64C3A3BB ON order_product');
        $this->addSql('ALTER TABLE order_product ADD particular_id INT DEFAULT NULL, ADD total_price DOUBLE PRECISION NOT NULL, DROP particulier_id, DROP payment_id, CHANGE date_order date_order DATETIME NOT NULL, CHANGE quantity_product quantity_product INT NOT NULL');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6CC3D5E73 FOREIGN KEY (particular_id) REFERENCES particular (id)');
        $this->addSql('CREATE INDEX IDX_2530ADE6CC3D5E73 ON order_product (particular_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD639A3624');
        $this->addSql('DROP INDEX IDX_D34A04AD639A3624 ON product');
        $this->addSql('ALTER TABLE product ADD comments_id INT DEFAULT NULL, ADD description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP category_product_id, DROP des, CHANGE image image VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reference reference VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE price price INT NOT NULL, CHANGE quantity quantity INT NOT NULL, CHANGE state state VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE recycling_index recycling_index INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD63379586 FOREIGN KEY (comments_id) REFERENCES commentary (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD63379586 ON product (comments_id)');
    }
}
