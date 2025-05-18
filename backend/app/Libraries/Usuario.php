<?php

namespace App\Libraries;

class Usuario
{
    private int $codigo;
    private string $nome;
    private string $email;
    private string $telefone;
    private string $senha;

    /** @var Ambiente[] */
    private array $ambientes;

    public function __construct(int $codigo, string $nome, string $email, string $telefone, string $senha, array $ambientes)
    {
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->senha = $senha;
        $this->ambientes = $ambientes;
    }

    public function getCodigo(): int { return $this->codigo; }
    public function getNome(): string { return $this->nome; }
    public function getEmail(): string { return $this->email; }
    public function getTelefone(): string { return $this->telefone; }
    public function getSenha(): string { return $this->senha; }
    public function getAmbientes(): array { return $this->ambientes; }
}
?>