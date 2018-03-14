export default {
  columns: {
    id: {
      name: "ID",
      type: "number",
      editable: false,
    },
    name: {
      name: "Name",
      type: "string",
      editable: true,
    },
    email: {
      name: "Email",
      type: "string",
      editable: true,
    },
    password: {
      name: "Password",
      type: "password",
      editable: true,
    },
    profileImage: {
      name: "Profile Image",
      type: "image",
      editable: true,
    },
    roles: {
      name: "Role",
      type: "checkbox",
      presentation: "badge",
      editable: true,
      options: [
        "super_user",
        "site_admin"
      ],
      optionNames : {
        "super_user": "Super User",
        "site_admin": "Site Admin",
      },
    }
  },
  "list": [
    "id",
    "profileImage",
    "name",
    "email",
    "roles",
  ],
  "show": [
    "id",
    "profileImage",
    "name",
    "email",
    "roles",
  ],
  "edit": [
    "profileImage",
    "name",
    "email",
    "password",
    "roles",
  ],
}
