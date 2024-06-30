(function() {
    var el = React.createElement;

    function ContactList() {
        const [contacts, setContacts] = React.useState([]);

        React.useEffect(() => {
            fetch('/wp-json/csp/v1/contacts')
                .then(response => response.json())
                .then(data => setContacts(data));
        }, []);

        return el('table', {},
            el('thead', {},
                el('tr', {},
                    el('th', {}, 'Name'),
                    el('th', {}, 'Address'),
                    el('th', {}, 'Phone'),
                    el('th', {}, 'Email'),
                    el('th', {}, 'Hobbies')
                )
            ),
            el('tbody', {},
                contacts.map(contact => el('tr', { key: contact.id },
                    el('td', {}, contact.name),
                    el('td', {}, contact.address),
                    el('td', {}, contact.phone),
                    el('td', {}, contact.email),
                    el('td', {}, contact.hobbies)
                ))
            )
        );
    }

    ReactDOM.render(el(ContactList), document.getElementById('csp-admin-app'));
})();
