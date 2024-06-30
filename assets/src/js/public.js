import "../scss/public.css";

document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('hobbies-input');
    const tagContainer = document.getElementById('tag-container');
    const hiddenInput = document.getElementById('hobbies');
    const suggestionsContainer = document.getElementById('suggestions-container');
    let tags = [];
    const suggestions = ['fishing', 'running', 'coding', 'photography', 'singing', 'gardening', 'travelling'];

    function createTag(label) {
        const div = document.createElement('div');
        div.setAttribute('class', 'tag');
        const span = document.createElement('span');
        span.innerHTML = label;
        const closeBtn = document.createElement('span');
        closeBtn.innerHTML = '&times;';
        closeBtn.setAttribute('class', 'close');
        closeBtn.onclick = function() {
            const index = tags.indexOf(label);
            tags.splice(index, 1);
            updateHiddenInput();
            tagContainer.removeChild(div);
        };
        div.appendChild(span);
        div.appendChild(closeBtn);
        return div;
    }

    function updateHiddenInput() {
        hiddenInput.value = tags.join(',');
    }

    function validateEmail(email) {
        const regex = /^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/;
        return regex.test(email);
    }
    

    function addTag(tag) {
        if (tag && !tags.includes(tag) && tags.length < 3) {
            tags.push(tag);
            const tagElement = createTag(tag);
            tagContainer.insertBefore(tagElement, input);
            input.value = '';
            updateHiddenInput();
            clearSuggestions();
        } else {
            alert('You can\'t input more then three tags');
            input.value = '';
        }
    }

    function clearSuggestions() {
        suggestionsContainer.innerHTML = '';
    }
    function ucfirst(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    input.addEventListener('input', function() {
        const query = input.value.toLowerCase();
        clearSuggestions();
        if (query) {
            const filteredSuggestions = suggestions.filter(suggestion => suggestion.toLowerCase().includes(query));
            filteredSuggestions.forEach(suggestion => {
                const div = document.createElement('div');
                div.setAttribute('class', 'suggestion');
                div.innerHTML = ucfirst(suggestion);
                div.onclick = function() {
                    addTag(suggestion);
                };
                suggestionsContainer.appendChild(div);
            });
        }
    });

    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addTag(input.value.trim());
        }
    });


    if (window?.signup) {
        signup.addEventListener('submit', (event) => {
            // event.preventDefault();
            const email = signup.querySelector('#email')?.value;
            console.log(email);
            if (!validateEmail(email)) {
                alert('Please enter a valid email address');
                return;
            }
            // const password = signup.querySelector('#password').value;
            // if (password.length < 8) {
            //     alert('Password must be at least 8 characters long');
            //     return;
            // }
            // const confirmPassword = signup.querySelector('#confirm-password').value;
            // if (password!== confirmPassword) {
            //     alert('Passwords do not match');
            //     return;
            // }
            // Add your code here to submit the form
            console.log('Form submitted successfully');
            // Reset form fields
            signup.querySelector('#signup').reset();
            // 
            return true;
        });
    }
    
});