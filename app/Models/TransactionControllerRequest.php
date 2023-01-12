<?php

namespace App\Models;

class TransactionControllerRequest
{
    public int $user_id;
    public string $history;
    public string $created_at;
    public ?string $transferred_from;
    public ?string $transferred_to;

    public function __construct(int $user_id,
                                string $history,
                               string $created_at,
                                ?string $transferred_from,
                               ?string $transferred_to)
    {

        $this->user_id = $user_id;
        $this->history = $history;
        $this->created_at = $created_at;
        $this->transferred_from = $transferred_from;
        $this->transferred_to = $transferred_to;
    }
    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function getHistory(): string
    {
        return $this->history;
    }
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getTransferredFrom(): ?string
    {
        return $this->transferred_from;
    }
    public function getTransferredTo(): ?string
    {
        return $this->transferred_to;
    }

}
