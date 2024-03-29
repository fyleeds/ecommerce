<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240105200140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart CHANGE totalprice totalprice INT NOT NULL');
        $this->addSql('ALTER TABLE cart_product CHANGE total_price total_price INT NOT NULL');
        $this->addSql('ALTER TABLE invoice CHANGE total_price total_price INT NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE price price INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart CHANGE totalprice totalprice DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE cart_product CHANGE total_price total_price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE invoice CHANGE total_price total_price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE price price DOUBLE PRECISION NOT NULL');
    }
}
