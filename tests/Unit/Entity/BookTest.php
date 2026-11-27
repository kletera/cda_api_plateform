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
        $expect = "test";
        //setter l'attribut
        $testBook->setTitle($expect);
        //2 Act
        $actual  = $testBook->getTitle();
        //3 Assert
        self::assertSame($expect, $actual );
    }

    public function testGetResumReturnGoodValue(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $expect = "test";
        //setter l'attribut
        $testBook->setResume($expect);
        //2 Act
        $actual  = $testBook->getResume();
        //3 Assert
        self::assertSame($expect, $actual );
    }

    public function testGetAuthorReturnGoodValue(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $expect = "test";
        //setter l'attribut
        $testBook->setAuthor($expect);
        //2 Act
        $actual  = $testBook->getAuthor();
        //3 Assert
        self::assertSame($expect, $actual );
    }

    public function testGetPublishAtReturnGoodValue(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $expect = new DateTimeImmutable();
        //setter l'attribut
        $testBook->setPublishAt($expect);
        //2 Act
        $actual  = $testBook->getPublishAt();
        //3 Assert
        self::assertSame($expect, $actual );
    }



    //Test qui échoue volontairement
    public function testGetTitleReturnInvalid(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $actual  = "test";
        $expect = "test2";
        //setter l'attribut
        $testBook->setTitle($actual);
        //2 Act
        $actual=$testBook->getTitle();
        //3 Assert
        self::assertNotSame($expect , $actual );
    }

    public function testGetResumReturnInvalid(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $actual  = "test";
        $expect = "test2";
        //setter l'attribut
        $testBook->setResume($actual);
        //2 Act
        $actual=$testBook->getResume();
        //3 Assert
        self::assertNotSame($expect , $actual );
    }

    public function testGetAuthorReturnInvalid(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $actual  = "test";
        $expect = "test2";
        //setter l'attribut
        $testBook->setAuthor($actual);
        //2 Act
        $actual=$testBook->getAuthor();
        //3 Assert
        self::assertNotSame($expect , $actual );
    }

    public function testGePublishAtReturnInvalid(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $actual  = new DateTimeImmutable();
        $expect = new DateTimeImmutable("1982-09-21");
        //setter l'attribut
        $testBook->setPublishAt($actual);
        //2 Act
        $actual=$testBook->getPublishAt();
        //3 Assert
        self::assertNotSame($expect , $actual );
    }

    // Erreur de format
    public function testTitreTypeErrorException(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //Expect
        $this->expectException(\TypeError::class);
        //2 Act
        $testBook->setTitle(["tests"]);
    }

    public function testResumTypeErrorException(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
         //créer un objet vide
        $testBook = new Book();
        //Expect
        $this->expectException(\TypeError::class);
        //2 Act
        $testBook->setResume(["tests"]);
    }

    public function testAuthorTypeErrorException(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //Expect
        $this->expectException(\TypeError::class);
        //2 Act
        $testBook->setAuthor(["tests"]);
    }

    public function testPublishAtTypeErrorException(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //Expect
        $this->expectException(\TypeError::class);
        //2 Act
        $testBook->setPublishAt(["tests"]);
    }
}