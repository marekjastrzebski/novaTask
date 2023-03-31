<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329175225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE abonament_types_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE abonaments_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contusions_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE horses_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE payment_methods_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE payments_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rides_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE roles_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE locodes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE locodes (id INT NOT NULL, locode VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, name_wo_diacritics VARCHAR(255) NOT NULL, sub_div VARCHAR(255) DEFAULT NULL, sub_div_name VARCHAR(255) DEFAULT NULL, port_terminal BOOLEAN DEFAULT NULL, airport_terminal BOOLEAN DEFAULT NULL, rail_terminal BOOLEAN DEFAULT NULL, road_terminal BOOLEAN DEFAULT NULL, postal_exchange BOOLEAN DEFAULT NULL, multimodal BOOLEAN DEFAULT NULL, fixed BOOLEAN DEFAULT NULL, border_crossing BOOLEAN DEFAULT NULL, date VARCHAR(255) NOT NULL, status VARCHAR(255) DEFAULT NULL, iata VARCHAR(255) DEFAULT NULL, coordinates VARCHAR(255) DEFAULT NULL, remarks VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE rides DROP CONSTRAINT fk_9d4620a3fb08edf6');
        $this->addSql('ALTER TABLE rides DROP CONSTRAINT fk_9d4620a381913d16');
        $this->addSql('ALTER TABLE rides DROP CONSTRAINT fk_9d4620a376b275ad');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT fk_1483a5e9d60322ac');
        $this->addSql('ALTER TABLE payments DROP CONSTRAINT fk_65d29b3281913d16');
        $this->addSql('ALTER TABLE contusions DROP CONSTRAINT fk_558c8b9776b275ad');
        $this->addSql('ALTER TABLE abonaments DROP CONSTRAINT fk_139c39d9c54c8c93');
        $this->addSql('ALTER TABLE abonaments DROP CONSTRAINT fk_139c39d919eb6921');
        $this->addSql('DROP TABLE rides');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE payments');
        $this->addSql('DROP TABLE payment_methods');
        $this->addSql('DROP TABLE abonament_types');
        $this->addSql('DROP TABLE contusions');
        $this->addSql('DROP TABLE horses');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE abonaments');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE locodes_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE abonament_types_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE abonaments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contusions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE horses_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payment_methods_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rides_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE roles_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE rides (id INT NOT NULL, trainer_id INT NOT NULL, abonament_id INT NOT NULL, horse_id INT DEFAULT NULL, date DATE NOT NULL, "time" TIME(0) WITHOUT TIME ZONE NOT NULL, cancelled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_9d4620a376b275ad ON rides (horse_id)');
        $this->addSql('CREATE INDEX idx_9d4620a381913d16 ON rides (abonament_id)');
        $this->addSql('CREATE INDEX idx_9d4620a3fb08edf6 ON rides (trainer_id)');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, role_id INT NOT NULL, first_name VARCHAR(20) NOT NULL, last_name VARCHAR(20) NOT NULL, phone INT NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(500) NOT NULL, active_login BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_1483a5e9d60322ac ON users (role_id)');
        $this->addSql('CREATE TABLE payments (id INT NOT NULL, abonament_id INT DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_65d29b3281913d16 ON payments (abonament_id)');
        $this->addSql('CREATE TABLE payment_methods (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE abonament_types (id INT NOT NULL, name VARCHAR(255) NOT NULL, rides_quantity INT NOT NULL, pay_period INT NOT NULL, ride_duration INT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contusions (id INT NOT NULL, horse_id INT NOT NULL, vet VARCHAR(255) DEFAULT NULL, description VARCHAR(5000) NOT NULL, recommendations VARCHAR(5000) DEFAULT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_558c8b9776b275ad ON contusions (horse_id)');
        $this->addSql('CREATE TABLE horses (id INT NOT NULL, name VARCHAR(255) NOT NULL, contusion BOOLEAN NOT NULL, picture VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, father VARCHAR(255) DEFAULT NULL, mother VARCHAR(255) DEFAULT NULL, remarks BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE roles (id INT NOT NULL, name VARCHAR(255) NOT NULL, level INT NOT NULL, description VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE abonaments (id INT NOT NULL, type_id INT NOT NULL, client_id INT NOT NULL, start_day DATE NOT NULL, renewable BOOLEAN NOT NULL, duration INT DEFAULT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_139c39d919eb6921 ON abonaments (client_id)');
        $this->addSql('CREATE INDEX idx_139c39d9c54c8c93 ON abonaments (type_id)');
        $this->addSql('ALTER TABLE rides ADD CONSTRAINT fk_9d4620a3fb08edf6 FOREIGN KEY (trainer_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rides ADD CONSTRAINT fk_9d4620a381913d16 FOREIGN KEY (abonament_id) REFERENCES abonaments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rides ADD CONSTRAINT fk_9d4620a376b275ad FOREIGN KEY (horse_id) REFERENCES horses (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT fk_1483a5e9d60322ac FOREIGN KEY (role_id) REFERENCES roles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payments ADD CONSTRAINT fk_65d29b3281913d16 FOREIGN KEY (abonament_id) REFERENCES abonaments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contusions ADD CONSTRAINT fk_558c8b9776b275ad FOREIGN KEY (horse_id) REFERENCES horses (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE abonaments ADD CONSTRAINT fk_139c39d9c54c8c93 FOREIGN KEY (type_id) REFERENCES abonament_types (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE abonaments ADD CONSTRAINT fk_139c39d919eb6921 FOREIGN KEY (client_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE locodes');
    }
}
