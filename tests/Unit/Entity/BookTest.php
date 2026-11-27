<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Book;
use DateTimeImmutable;

class BookTest extends TestCase
{   
    // Methode
    // Test Valide
    public function testGetTitreReturnGoodValue(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $value = "test";
        //setter l'attribut
        $testBook->setTitle($value);
        //2 Act
        $result = $testBook->getTitle();
        //3 Assert
        $this->assertSame($value, $result);
    }

    public function testGetResumReturnGoodValue(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $value = "test";
        //setter l'attribut
        $testBook->setResume($value);
        //2 Act
        $result = $testBook->getResume();
        //3 Assert
        $this->assertSame($value, $result);
    }

    public function testGetAuthorReturnGoodValue(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $value = "test";
        //setter l'attribut
        $testBook->setAuthor($value);
        //2 Act
        $result = $testBook->getAuthor();
        //3 Assert
        $this->assertSame($value, $result);
    }

    public function testGetPublishAtReturnGoodValue(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $value = new DateTimeImmutable();
        //setter l'attribut
        $testBook->setPublishAt($value);
        //2 Act
        $result = $testBook->getPublishAt();
        //3 Assert
        $this->assertSame($value, $result);
    }



    //Test qui échoue volontairement
    public function testGetTitleReturnInvalid(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $result = "test";
        $value = "test2";
        //setter l'attribut
        $resultat = $testBook->setTitle($value);
        //2 Act
        //3 Assert
        $this->assertNotSame($result, $result);
    }

    public function testGetResumReturnInvalid(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $result = "test";
        $value = "test2";
        //setter l'attribut
        $resultat = $testBook->setResume($value);
        //2 Act
        //3 Assert
        $this->assertNotSame($result, $result);
    }

    public function testGetAuthorReturnInvalid(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $result = "test";
        $value = "test2";
        //setter l'attribut
        $resultat = $testBook->setAuthor($value);
        //2 Act
        //3 Assert
        $this->assertNotSame($result, $result);
    }

    public function testGePublishAtReturnInvalid(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $result = new DateTimeImmutable();
        $value = new DateTimeImmutable("1982-09-21");
        //setter l'attribut
        $resultat = $testBook->setPublishAt($value);
        //2 Act
        //3 Assert
        $this->assertNotSame($result, $result);
    }
}