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
  },
  "list": [
    "id",
    "profileImage",
    "name",
    "email",
  ],
  "show": [
    "id",
    "profileImage",
    "name",
    "email",
  ],
  "edit": [
    "profileImage",
    "name",
    "email",
    "password",
  ],
}
