export default {
    "columns": {
        "id": {
            "name": "Id",
            "type": "text",
            "editable": false
        },
        "name": {
            "name": "Name",
            "type": "text",
            "editable": true
        },
        "email": {
            "name": "Email",
            "type": "text",
            "editable": true
        },
        "profile_image_id": {
            "name": "Profile Image Id",
            "type": "image",
            "editable": true
        },
        "created_at": {
            "name": "Created At",
            "type": "text",
            "editable": false
        },
        "updated_at": {
            "name": "Updated At",
            "type": "text",
            "editable": false
        }
    },
    "list": [
        "name",
        "email",
        "profile_image_id"
    ],
    "show": [
        "id",
        "name",
        "email",
        "profile_image_id",
        "created_at",
        "updated_at"
    ],
    "edit": [
        "name",
        "email",
        "profile_image_id"
    ]
};
