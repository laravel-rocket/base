export default {
  items: [
    {
      name: 'Desktop',
      url: '/desktop',
      icon: 'icon-speedometer'
    },
    {
      title: true,
      name: 'UI elements',
      wrapper: {            // optional wrapper object
        element: "span",      // required valid HTML5 element tag
        attributes: {}        // optional valid JS object with JS API naming ex: { className: "my-class", style: { fontFamily: "Verdana" }, id: "my-id"}
      },
      class: ""             // optional class names space delimited list for title item ex: "text-center"
    },
    {
      name: 'Components',
      url: '/admin-users',
      icon: 'icon-puzzle',
      children: [
        {
          name: 'Admin Users',
          url: '/admin-users',
          icon: 'icon-puzzle'
        }
      ]
    }
  ]
};
