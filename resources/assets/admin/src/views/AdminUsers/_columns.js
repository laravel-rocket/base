export default {
  columns: {
    id: {
      name: "ID",
      type: "number",
      editable: false,
      queryName: "id"
    },
    name: {
      name: "Name",
      type: "string",
      editable: true,
      queryName: "name"
    },
    email: {
      name: "Email",
      type: "string",
      editable: true,
      queryName: "email"
    },
    password: {
      name: "Password",
      type: "password",
      editable: true,
      queryName: "password"
    },
    profileImage: {
      name: "Profile Image",
      type: "image",
      editable: true,
      queryName: "profile_image_id"
    },
    dateTime: {
        name: "Date Time",
        type: "datetime",
        editable: true,
        queryName: "datetime"
    },
    date: {
        name: "Date",
        type: "date",
        editable: true,
        queryName: "date"
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
    'date',
    'dateTime',
    "profileImage",
    "name",
    "email",
    "password",
    "roles",
  ],
}
