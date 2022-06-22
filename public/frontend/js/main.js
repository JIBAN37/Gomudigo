window.addEventListener('load', () => {
  const chatBox = document.querySelector('#chat-box');

  /*
   // navigation menu
  */
  (function () {
    const navMenu = document.getElementById('mainMenuOffcanvas');
    const menuButtonSm = document.querySelector('#header .navbar-nav-toggler-sm');
    const menuButton = document.querySelector('#header .navbar-nav-toggler');
    const body = document.getElementById('main');

    function getBackdrop() {
      let elem, menuBackdrop;

      if ((elem = document.querySelector('#header .offcanvas-backdrop'))) {
        menuBackdrop = elem;
      }

      return menuBackdrop;
    }

    menuButtonSm.addEventListener('click', function () {
      const self = this;
      navMenu.classList.toggle('show');
      if(navMenu.style.visibility== 'visible'){
        navMenu.style.visibility= 'hidden';
      }else{
        navMenu.style.visibility= 'visible';
      }
      const menuBackdrop = getBackdrop();

      self.classList.toggle('active');
      menuBackdrop.addEventListener('click', function () {
        self.classList.remove('active');
        
      });
    });

    menuButton.addEventListener('click', function () {
      navMenu.classList.toggle('toggle');
      body.classList.toggle('hidden-menu');
    });

    function responsiveFilter(windowSise) {
      const backdrop = getBackdrop();
      if (windowSise >= 768) {
        if (backdrop != null) {
          backdrop.style.display = 'none';
        }
        // if (!navMenu.classList.contains('show')) {
        navMenu.classList.add('show');
        navMenu.classList.remove('toggle');
        // }
        body.classList.remove('hidden-menu');
      } else {
        if (backdrop != null) {
          backdrop.style.display = 'block';
        }
        if (navMenu.classList.contains('show')) {
          //navMenu.classList.remove('show');
          navMenu.classList.remove('toggle');
        }
        body.classList.add('hidden-menu'); 
       // navMenu.style.visibility= 'visible';
      }
    }

    function reportWindowSize() {
      const screenSize = innerWidth;
      responsiveFilter(screenSize);
    }

    reportWindowSize();

    window.addEventListener('resize', reportWindowSize);
  })();

  /*
   // product cart
  */
  (function () {
    const cartTrigger = document.querySelector('#cart-togglerOne');
    const cartTrigger2 = document.querySelector('#cart-togglerTwo');
    const togglers = [cartTrigger, cartTrigger2];

    const offcanvas = document.querySelector('#sidebar .offcanvas');
    var bsOffcanvas = new bootstrap.Offcanvas(offcanvas);

    togglers.forEach(function (toggler) {
      toggler.addEventListener('click', function () {
        bsOffcanvas.toggle();

        if (this == cartTrigger) {
          chatBox.classList.add('side-bar-active');
        } else {
          chatBox.classList.remove('side-bar-active');
        }
      });
    });
  })();

  /*
   // user chat box
  */
  (function () {
    const wrapper = document.querySelector('#chat-box');
    const chatBox = document.querySelector('#chat-box .chatBox');
    const chatTriggerOne = document.querySelector('#chat-box .chat-toggler');
    const chatTriggerTwo = document.querySelector('.footer-navbar-sm .chat-toggler');
    const triggers = [chatTriggerOne, chatTriggerTwo];
    const chatClose = document.querySelector('#chat-box .close-btn');
    const messages = document.querySelectorAll('.user-message .message');
    const inputField = document.querySelector('#send-message');
    const buttonMore = document.querySelector('.chat-bottom .input-group-text .btn-more');
    const buttonSend = document.querySelector('.chat-bottom .input-group-text .btn-send');
    const containerHeight = 22.5;

    triggers.forEach(function (chatTrigger) {
      chatTrigger.addEventListener('click', function () {
        this.classList.add('hidden');
        chatBox.classList.add('active');
        wrapper.classList.add('active-chat');

        if (!wrapper.classList.contains('active')) {
          wrapper.classList.add('active');
        }
      });
    });

    chatClose.addEventListener('click', function () {
      chatTriggerOne.classList.remove('hidden');
      chatBox.classList.remove('active');
      wrapper.classList.remove('active-chat');
      wrapper.classList.remove('active');
    });

    messages.forEach((element) => {
      if (element.offsetHeight > 30) {
        element.classList.remove('rounded-pill');
        element.classList.add('rounded');
      }
      element.classList.remove('rounded');
      element.classList.add('rounded-pill');
    });

    inputField.addEventListener('input', function (e) {
      e.preventDefault();

      if (this.value.length >= 1) {
        buttonMore.classList.add('hidden');
        buttonSend.classList.add('active');
      } else {
        buttonMore.classList.remove('hidden');
        buttonSend.classList.remove('active');
      }
    });
  })();

  /*
   // product add to cart
  */
  (function () {
    const addToCartButtons = document.querySelectorAll('.cart-btns .add-to-cart');
    //  const addToCart = document.querySelectorAll('.after-added-to-cart')

    if (addToCartButtons) {
      addToCartButtons.forEach(function (button) {
        button.addEventListener('click', function () {
          const siblingEl = this.nextElementSibling;

          this.classList.add('hidden');
          siblingEl.classList.add('active');
        });
      });
    }
  })();
});
