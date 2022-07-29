<?php
declare(strict_types=1);
namespace Ap\Model;

interface ModelInterface{
    public function get(int $id): array;
    public function create(array $data): int;
    public function edit(int $id, array $data): void;
    public function delete(int $id): void;
}

