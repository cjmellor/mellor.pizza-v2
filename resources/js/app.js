import './bootstrap';

document.addEventListener('livewire:navigating', (event) => {
    event.detail.onSwap(() => {
        document.body.dataset.navigated = '';
    });
});
