const { registerBlockType } = wp.blocks;
const { SelectControl } = wp.components;
const { InspectorControls } = wp.blockEditor;
const { withSelect } = wp.data;

registerBlockType('csp/contact-list', {
    title: 'Contact List',
    icon: 'id-alt',
    category: 'widgets',
    attributes: {
        selectedPerson: {
            type: 'string',
        },
    },
    edit: withSelect(select => {
        let people = select('core').getEntityRecords('postType', 'csp_user');
        if (!people) {people = [];}
        return {
            people: (!people)?[]:people
        };
    })(({ attributes, setAttributes, people }) => {
        const options = people ? people.map(person => ({
            value: person.id,
            label: person.title.rendered,
        })) : [];
        return (
            <div>
                {/* <InspectorControls> */}
                    <SelectControl
                        label="Select Person"
                        value={attributes.selectedPerson}
                        options={[{ value: 0, label: 'Select a person' }, ...options]}
                        onChange={(value) => setAttributes({ selectedPerson: value })}
                    />
                {/* </InspectorControls> */}
                <p>{attributes.selectedPerson ? `Selected Person ID: ${attributes.selectedPerson}` : 'No person selected'}</p>
            </div>
        );
    }),
    save: () => {
        return null;
    },
});
