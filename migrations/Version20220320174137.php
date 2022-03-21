<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320174137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(file_get_contents("./scripts/city.sql"));
        // $this->addSql(file_get_contents("./scripts/restaurant.sql"));
        // $this->addSql(file_get_contents("./scripts/user.sql"));
        // $this->addSql(file_get_contents("./scripts/restaurantPicture.sql"));
        // $this->addSql(file_get_contents("./scripts/review.sql"));

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
