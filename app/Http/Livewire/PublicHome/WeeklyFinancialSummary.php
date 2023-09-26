<?php

namespace App\Http\Livewire\PublicHome;

use App\Transaction;
use Livewire\Component;

class WeeklyFinancialSummary extends Component
{
    public $allBalance;
    public $thisWeekBalance;
    public $thisWeekIncome;
    public $thisWeekSpending;

    protected function getThisWeekTansactions()
    {
        $firstDayInWeek = now()->startOfWeek()->format('Y-m-d');
        $lastDayInWeek = now()->endOfWeek()->format('Y-m-d');
        $bookId = config('masjid.default_book_id');
        $transactionQuery = Transaction::query();
        $transactionQuery->where('date', '>=', $firstDayInWeek);
        $transactionQuery->where('date', '<=', $lastDayInWeek);
        $transactionQuery->where('book_id', $bookId);
        return $transactionQuery->orderBy('date', 'asc')->with('category', 'book')->get();
    }

    public function render()
    {
        return view('livewire.public_home.weekly_financial_summary');
    }

    public function mount()
    {
        $lastWeekTransaction = auth()->activeBook()
            ->getBalance(now()->startOfWeek()->subDay()->format('Y-m-d'));;
        $transaction = $this->getThisWeekTansactions();
        $transaction->each(function ($transaction) {
            if ($transaction->in_out) {
                $this->thisWeekIncome = $this->thisWeekIncome + $transaction->amount;
            } else {
                $this->thisWeekSpending = $this->thisWeekSpending + $transaction->amount;
            }
        });
        $this->thisWeekBalance = $lastWeekTransaction;
        $this->allBalance = $lastWeekTransaction + $this->thisWeekIncome - $this->thisWeekSpending;
    }
}