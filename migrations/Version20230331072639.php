<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331072639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE locodes (id INT NOT NULL, locode VARCHAR(255) NOT NULL, country_code VARCHAR(255) NOT NULL, zone_code VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, name_wo_diacritics VARCHAR(255) NOT NULL, sub_div VARCHAR(255) DEFAULT NULL, sub_div_name VARCHAR(255) DEFAULT NULL, port_terminal BOOLEAN DEFAULT NULL, airport_terminal BOOLEAN DEFAULT NULL, rail_terminal BOOLEAN DEFAULT NULL, road_terminal BOOLEAN DEFAULT NULL, postal_exchange BOOLEAN DEFAULT NULL, multimodal BOOLEAN DEFAULT NULL, fixed BOOLEAN DEFAULT NULL, border_crossing BOOLEAN DEFAULT NULL, date VARCHAR(255) NOT NULL, status VARCHAR(255) DEFAULT NULL, iata VARCHAR(255) DEFAULT NULL, coordinates VARCHAR(255) DEFAULT NULL, remarks VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE locodes');
    }
}
