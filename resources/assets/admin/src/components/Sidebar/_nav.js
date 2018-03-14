export default {
  items: [
    {
      name: 'Desktop',
      url: '/desktop',
      icon: 'fa fa-desktop'
    },
    {
      divider: true
    },
    {
      title: true,
      name: 'CRUD',
      wrapper: {            // optional wrapper object
        element: "span",      // required valid HTML5 element tag
        attributes: {}        // optional valid JS object with JS API naming ex: { className: "my-class", style: { fontFamily: "Verdana" }, id: "my-id"}
      },
      class: ""             // optional class names space delimited list for title item ex: "text-center"
    },
    {
      name: 'Admin Users',
      url: '/admin-users',
      icon: 'icon-puzzle'
    }
  ]
};
