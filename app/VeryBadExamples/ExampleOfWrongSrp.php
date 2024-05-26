<?php

namespace App\VeryBadExamples;

// Interfejsy i klasy dla walidacji zamówienia
interface OrderValidatorStep1Interface { public function validateStep1(array $order): bool; }
interface OrderValidatorStep2Interface { public function validateStep2(array $order): bool; }
interface OrderValidatorStep3Interface { public function validateStep3(array $order): bool; }
// ... powtarzamy aż do 20
interface OrderValidatorStep20Interface { public function validateStep20(array $order): bool; }

class OrderValidatorStep1 implements OrderValidatorStep1Interface { public function validateStep1(array $order): bool { return true; } }
class OrderValidatorStep2 implements OrderValidatorStep2Interface { public function validateStep2(array $order): bool { return true; } }
class OrderValidatorStep3 implements OrderValidatorStep3Interface { public function validateStep3(array $order): bool { return true; } }
// ... powtarzamy aż do 20
class OrderValidatorStep20 implements OrderValidatorStep20Interface { public function validateStep20(array $order): bool { return true; } }

// Interfejsy i klasy dla zapisywania zamówienia
interface OrderSaverStep1Interface { public function saveStep1(array $order): bool; }
interface OrderSaverStep2Interface { public function saveStep2(array $order): bool; }
interface OrderSaverStep3Interface { public function saveStep3(array $order): bool; }
// ... powtarzamy aż do 20
interface OrderSaverStep20Interface { public function saveStep20(array $order): bool; }

class OrderSaverStep1 implements OrderSaverStep1Interface { public function saveStep1(array $order): bool { return true; } }
class OrderSaverStep2 implements OrderSaverStep2Interface { public function saveStep2(array $order): bool { return true; } }
class OrderSaverStep3 implements OrderSaverStep3Interface { public function saveStep3(array $order): bool { return true; } }
// ... powtarzamy aż do 20
class OrderSaverStep20 implements OrderSaverStep20Interface { public function saveStep20(array $order): bool { return true; } }

// Interfejsy i klasy dla powiadamiania o zamówieniu
interface OrderNotifierStep1Interface { public function notifyStep1(array $order): bool; }
interface OrderNotifierStep2Interface { public function notifyStep2(array $order): bool; }
interface OrderNotifierStep3Interface { public function notifyStep3(array $order): bool; }
// ... powtarzamy aż do 20
interface OrderNotifierStep20Interface { public function notifyStep20(array $order): bool; }

class OrderNotifierStep1 implements OrderNotifierStep1Interface { public function notifyStep1(array $order): bool { return true; } }
class OrderNotifierStep2 implements OrderNotifierStep2Interface { public function notifyStep2(array $order): bool { return true; } }
class OrderNotifierStep3 implements OrderNotifierStep3Interface { public function notifyStep3(array $order): bool { return true; } }
// ... powtarzamy aż do 20
class OrderNotifierStep20 implements OrderNotifierStep20Interface { public function notifyStep20(array $order): bool { return true; } }

// Klasa OrderProcessor, która ma wszystkie zależności
class OrderProcessor {
    private $validatorSteps = [];
    private $saverSteps = [];
    private $notifierSteps = [];

    public function __construct(
        OrderValidatorStep1Interface $validatorStep1, OrderValidatorStep2Interface $validatorStep2,
        OrderValidatorStep3Interface $validatorStep3, /* ... */ OrderValidatorStep20Interface $validatorStep20,
        OrderSaverStep1Interface $saverStep1, OrderSaverStep2Interface $saverStep2,
        OrderSaverStep3Interface $saverStep3, /* ... */ OrderSaverStep20Interface $saverStep20,
        OrderNotifierStep1Interface $notifierStep1, OrderNotifierStep2Interface $notifierStep2,
        OrderNotifierStep3Interface $notifierStep3, /* ... */ OrderNotifierStep20Interface $notifierStep20
    ) {
        $this->validatorSteps = func_get_args();
        $this->saverSteps = array_slice($this->validatorSteps, 20, 20);
        $this->notifierSteps = array_slice($this->validatorSteps, 40, 20);
    }

    public function process(array $order): bool {
        foreach ($this->validatorSteps as $validatorStep) {
            if (!$validatorStep->validateStep1($order)) {
                return false;
            }
        }
        foreach ($this->saverSteps as $saverStep) {
            if (!$saverStep->saveStep1($order)) {
                return false;
            }
        }
        foreach ($this->notifierSteps as $notifierStep) {
            if (!$notifierStep->notifyStep1($order)) {
                return false;
            }
        }
        return true;
    }
}

// Przykład użycia
$orderProcessor = new OrderProcessor(
    new OrderValidatorStep1(), new OrderValidatorStep2(), new OrderValidatorStep3(), /* ... */ new OrderValidatorStep20(),
    new OrderSaverStep1(), new OrderSaverStep2(), new OrderSaverStep3(), /* ... */ new OrderSaverStep20(),
    new OrderNotifierStep1(), new OrderNotifierStep2(), new OrderNotifierStep3(), /* ... */ new OrderNotifierStep20()
);
$order = ['item' => 'Book', 'quantity' => 1];

if ($orderProcessor->process($order)) {
    echo "Zamówienie zostało przetworzone pomyślnie.";
} else {
    echo "Wystąpił błąd podczas przetwarzania zamówienia.";
}
?>
