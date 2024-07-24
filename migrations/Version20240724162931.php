<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724162931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient (id UUID NOT NULL, ingredient_category_id UUID NOT NULL, title VARCHAR(255) NOT NULL, measurement_type VARCHAR(255) NOT NULL, nutritional_information_calories DOUBLE PRECISION DEFAULT \'0\' NOT NULL, nutritional_information_protein DOUBLE PRECISION DEFAULT \'0\' NOT NULL, nutritional_information_carbohydrates DOUBLE PRECISION DEFAULT \'0\' NOT NULL, nutritional_information_fats DOUBLE PRECISION DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ingredient_category (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_category');
    }
}
