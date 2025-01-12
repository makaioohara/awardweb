// Sidenavbar Function
const body = document.querySelector('body'),
      sidenavbar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".unique-search-box");

toggle.addEventListener("click" , () =>{
  sidenavbar.classList.toggle("sidenavbar-close");
});

if (searchBtn) {
  searchBtn.addEventListener("click" , () =>{
    sidenavbar.classList.remove("sidenavbar-close");
  });
}

function checkViewport() {
  if (window.innerWidth > 1023) {
    
  }
}
checkViewport();
window.addEventListener("resize", checkViewport);

// Disable All Input Fields When One Is Active
var inputFields = document.querySelectorAll('input');

inputFields.forEach(function(input) {
    input.addEventListener('focus', function() {
        inputFields.forEach(function(field) {
            if (field !== input) {
                field.disabled = true;
            }
        });
    });
    
    input.addEventListener('blur', function() {
        inputFields.forEach(function(field) {
            field.disabled = false;
        });
    });
});

// Search Input 
const searchInput = body.querySelector("#search-input");

function containsRestrictedCharacters(text) {
  var pattern = '[!"#$%&\'()*+\\-./:;<=>?@[\\\\\\]^_`{|}~]';
  var restrictedCharacters = new RegExp(pattern);
  return restrictedCharacters.test(text);
}

if (searchInput) {
  searchInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      var query = this.value.trim();
      if (query !== '') {
        if (containsRestrictedCharacters(query)) {
          this.value = '';
        } else {
          window.location.href = '/?s=' + encodeURIComponent(query);
        }
      }
    }
  });
}

// Share Button
document.getElementById("share-option").addEventListener("click", function() {
  var currentLink = window.location.href;
  var textToCopy = currentLink;

  if (navigator.share) {
    navigator.share({
      title: 'Baka! Share It!',
      text: document.title,
      url: currentLink
    }).then(() => {
      console.log('Thanks for sharing!');
    }).catch((error) => {
      console.error('Error sharing:', error);
    });
  } else {
    fallbackCopyToClipboard(textToCopy);
  }
});

function fallbackCopyToClipboard(text) {
  var dummyElement = document.createElement("textarea");
  dummyElement.value = text;
  document.body.appendChild(dummyElement);
  dummyElement.select();
  document.execCommand("copy");
  document.body.removeChild(dummyElement);
  alert("Link to this page copied to clipboard!");
}

// What's New Page Tab

document.addEventListener('DOMContentLoaded', function() {
    const tabsbuttons = document.querySelectorAll('.tabs-switch button');
    const tabscontent = document.querySelectorAll('.whats-new-tabs');

    tabsbuttons.forEach((button, index) => {
        button.addEventListener('click', function() {
            tabsbuttons.forEach(btn => btn.classList.remove('active-tab'));
            this.classList.add('active-tab');
            tabscontent.forEach(div => div.classList.remove('active-tab-content'));
            tabscontent[index].classList.add('active-tab-content');
        });
    });
});