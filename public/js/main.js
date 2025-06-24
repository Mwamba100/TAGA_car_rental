let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
  menu.classList.toggle('bx-x');
  navbar.classList.toggle('active');
}

window.onscroll = () => {
  menu.classList.remove('bx-x');
  navbar.classList.remove('active');
}

const sr = ScrollReveal ({
  distance: '60px',
  duration: 2500,
  delay: 400,
  reset: true
})

sr.reveal('.text',{delay: 200, origin: 'top'});
sr.reveal('.form-container form',{delay: 600, origin: 'left'});
sr.reveal('.heading',{delay: 400, origin: 'top'});
sr.reveal('.ride-container .box',{delay: 400, origin: 'top'});
sr.reveal('.services-container .box',{delay: 400, origin: 'top'});
sr.reveal('.about-container .box',{delay: 400, origin: 'top'});
sr.reveal('.reviews-container',{delay: 400, origin: 'top'});
sr.reveal('.newsletter .box',{delay: 400, origin: 'bottom'});

// Payment Modal logic
const rentButtons = document.querySelectorAll('.services-container .btn');
const paymentModal = document.getElementById('paymentModal');
const paymentForm = document.getElementById('paymentForm');

rentButtons.forEach(btn => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    paymentModal.classList.remove('hidden');
  });
});

function closePaymentModal() {
  paymentModal.classList.add('hidden');
}

// Optional: handle form submit
paymentForm.addEventListener('submit', function (e) {
  e.preventDefault();
  const method = document.querySelector('input[name="payment"]:checked').value;
  alert(`Payment method selected: ${method} \n(Proceeding to dummy confirmation page...)`);
  closePaymentModal();
});