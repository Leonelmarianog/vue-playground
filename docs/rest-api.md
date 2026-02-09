# REST API

## Member Resources

**GET /members/{memberId}**
*   **Description:** Retrieves a single member. Use the value `me` as `memberId` for the authenticated user's data.
*   **Sample Request:** `GET /api/members/me`
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "a0a0a0a0-a0a0-4a0a-a0a0-a0a0a0a0a0a0",
            "full_name": "Jane Doe",
            "initials": "JD",
            "email": "jane.doe@example.com",
            "avatar_url": "https://example.com/avatars/janedoe.jpg",
            "bio": "Lorem ipsum dolor sit amet.",
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**PATCH /members/{memberId}**
*   **Description:** Updates a single member.
*   **Sample Request:** `PATCH /api/members/a0a0a0a0-a0a0-4a0a-a0a0-a0a0a0a0a0a0`
    ```json
    {
        "full_name": "Janet Doe",
        "bio": "This is my new bio!."
    }
    ```
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "a0a0a0a0-a0a0-4a0a-a0a0-a0a0a0a0a0a0",
            "full_name": "Janet Doe",
            "initials": "JD",
            "email": "jane.doe@example.com",
            "avatar_url": "https://example.com/avatars/janedoe.jpg",
            "bio": "Updated biography.",
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**GET /members/{memberId}/boards**
*   **Description:** Retrieves all boards belonging to a member.
*   **Sample Request:** `GET /api/members/me/boards`
*   **Sample Response:**
    ```json
    {
        "data": [
            {
                "id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
                "name": "Project Alpha",
                "description": "First project board.",
                "created_at": "2021-01-01T00:00:00+00:00",
                "updated_at": "2021-01-01T00:00:00+00:00",
                "deleted_at": null
            },
            {
                "id": "c2c2c2c2-c2c2-4c2c-c2c2-c2c2c2c2c2c2",
                "name": "Team Meeting Notes",
                "description": "Notes for weekly team meetings.",
                "created_at": "2021-01-01T00:00:00+00:00",
                "updated_at": "2021-01-01T00:00:00+00:00",
                "deleted_at": null
            }
        ],
        "links": { },
        "meta": { }
    }
    ```

---

## Board Resources

**GET /boards/{boardId}**
*   **Description:** Retrieves a single board.
*   **Sample Request:** `GET /api/boards/b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1`
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
            "fk_member_id": "a0a0a0a0-a0a0-4a0a-a0a0-a0a0a0a0a0a0",
            "name": "Project Alpha",
            "description": "First project board.",
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**POST /boards**
*   **Description:** Creates a new board.
*   **Sample Request:** `POST /api/boards`
    ```json
    {
        "name": "New Project Board",
        "description": "A board for planning the new project."
    }
    ```
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "d3d3d3d3-d3d3-4d3d-d3d3-d3d3d3d3d3d3",
            "fk_member_id": "a0a0a0a0-a0a0-4a0a-a0a0-a0a0a0a0a0a0",
            "name": "New Project Board",
            "description": "A board for planning the new project.",
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**PATCH /boards/{boardId}**
*   **Description:** Updates a single board.
*   **Sample Request:** `PATCH /api/boards/b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1`
    ```json
    {
        "name": "Project Alpha (Revised)",
        "description": "Updated description for Project Alpha."
    }
    ```
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
            "fk_member_id": "a0a0a0a0-a0a0-4a0a-a0a0-a0a0a0a0a0a0",
            "name": "Project Alpha (Revised)",
            "description": "Updated description for Project Alpha.",
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**DELETE /boards/{boardId}**
*   **Description:** Deletes a single board.
*   **Sample Request:** `DELETE /api/boards/b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1`
*   **Sample Response:** `HTTP 200 OK`

**GET /boards/{boardId}/lists**
*   **Description:** Retrieves all lists belonging to a board.
*   **Sample Request:** `GET /api/boards/b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1/lists`
*   **Sample Response:**
    ```json
    {
        "data": [
            {
                "id": "e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4",
                "fk_board_id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
                "name": "To Do",
                "position": 0,
                "created_at": "2021-01-01T00:00:00+00:00",
                "updated_at": "2021-01-01T00:00:00+00:00",
                "deleted_at": null
            },
            {
                "id": "f5f5f5f5-f5f5-4f5f-f5f5-f5f5f5f5f5f5",
                "fk_board_id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
                "name": "In Progress",
                "position": 1,
                "created_at": "2021-01-01T00:00:00+00:00",
                "updated_at": "2021-01-01T00:00:00+00:00",
                "deleted_at": null
            }
        ],
        "links": { },
        "meta": { }
    }
    ```

**GET /boards/{boardId}/labels**
*   **Description:** Retrieves all labels belonging to a board.
*   **Sample Request:** `GET /api/boards/b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1/labels`
*   **Sample Response:**
    ```json
    {
        "data": [
            {
                "id": "g6g6g6g6-g6g6-4g6g-g6g6-g6g6g6g6g6g6",
                "fk_board_id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
                "name": "Bug",
                "color": "#FF0000",
                "created_at": "2021-01-01T00:00:00+00:00",
                "updated_at": "2021-01-01T00:00:00+00:00",
                "deleted_at": null
            },
            {
                "id": "h7h7h7h7-h7h7-4h7h-h7h7-h7h7h7h7h7h7",
                "fk_board_id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
                "name": "Feature",
                "color": "#00FF00",
                "created_at": "2021-01-01T00:00:00+00:00",
                "updated_at": "2021-01-01T00:00:00+00:00",
                "deleted_at": null
            }
        ],
        "links": { },
        "meta": { }
    }
    ```

**PATCH /boards/{boardId}/lists/reorder**
*   **Description:** Reorders lists within a specific board by updating their positions.
*   **Sample Request:** `PATCH /api/boards/b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1/lists/reorder`
    ```json
    [
        { "id": "f5f5f5f5-f5f5-4f5f-f5f5-f5f5f5f5f5f5", "position": 0 },
        { "id": "e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4", "position": 1 }
    ]
    ```
*   **Sample Response:** `HTTP 200 OK`.

---

## List Resources

**GET /lists/{listId}**
*   **Description:** Retrieves a single list.
*   **Sample Request:** `GET /api/lists/e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4`
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4",
            "fk_board_id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
            "name": "To Do",
            "position": 0,
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**POST /lists**
*   **Description:** Creates a new list.
*   **Sample Request:** `POST /api/lists`
    ```json
    {
        "fk_board_id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
        "name": "Done",
        "position": 2
    }
    ```
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "i8i8i8i8-i8i8-4i8i-i8i8-i8i8i8i8i8i8",
            "fk_board_id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
            "name": "Done",
            "position": 2,
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**PATCH /lists/{listId}**
*   **Description:** Updates a single list.
*   **Sample Request:** `PATCH /api/lists/e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4`
    ```json
    {
        "name": "To Do (Urgent)"
    }
    ```
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4",
            "fk_board_id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
            "name": "To Do (Urgent)",
            "position": 0,
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**DELETE /lists/{listId}**
*   **Description:** Deletes a specific list.
*   **Sample Request:** `DELETE /api/lists/e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4`
*   **Sample Response:** `HTTP 200 OK`

**GET /lists/{listId}/cards**
*   **Description:** Retrieves all cards belonging to a list.
*   **Sample Request:** `GET /api/lists/e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4/cards`
*   **Sample Response:**
    ```json
    {
        "data": [
            {
                "id": "j9j9j9j9-j9j9-4j9j-j9j9-j9j9j9j9j9j9",
                "fk_list_id": "e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4",
                "name": "Design UI Mockups",
                "description": "Create high-fidelity mockups for the main dashboard.",
                "position": 0,
                "created_at": "2021-01-01T00:00:00+00:00",
                "updated_at": "2021-01-01T00:00:00+00:00",
                "deleted_at": null
            },
            {
                "id": "k1k1k1k1-k1k1-4k1k-k1k1-k1k1k1k1k1k1",
                "fk_list_id": "e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4",
                "name": "Setup Database",
                "description": null,
                "position": 1,
                "created_at": "2021-01-01T00:00:00+00:00",
                "updated_at": "2021-01-01T00:00:00+00:00",
                "deleted_at": null
            }
        ],
        "links": { },
        "meta": { }
    }
    ```

**PATCH /lists/{listId}/cards/reorder**
*   **Description:** Reorders cards within a specific list, or moves cards into this list by updating their positions and `fk_list_id`.
*   **Sample Request:** `PATCH /api/lists/e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4/cards/reorder`
    ```json
    [
        { "id": "k1k1k1k1-k1k1-4k1k-k1k1-k1k1k1k1k1k1", "position": 0 },
        { "id": "j9j9j9j9-j9j9-4j9j-j9j9-j9j9j9j9j9j9", "position": 1 }
    ]
    ```
*   **Sample Response:** `HTTP 200 OK`

---

## Card Resources

**GET /cards/{cardId}**
*   **Description:** Retrieves a single card.
*   **Sample Request:** `GET /api/cards/j9j9j9j9-j9j9-4j9j-j9j9-j9j9j9j9j9j9`
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "j9j9j9j9-j9j9-4j9j-j9j9-j9j9j9j9j9j9",
            "fk_list_id": "e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4",
            "name": "Design UI Mockups",
            "description": "Create high-fidelity mockups for the main dashboard.",
            "position": 0,
            "labels": [
               {
                   "id": "g6g6g6g6-g6g6-4g6g-g6g6-g6g6g6g6g6g6",
                   "name": "Bug",
                   "color": "#FF0000"
               }
            ],
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**POST /cards**
*   **Description:** Creates a new card.
*   **Sample Request:** `POST /api/cards`
    ```json
    {
        "fk_list_id": "e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4",
        "name": "Write API Docs",
        "description": "Document all new API endpoints."
    }
    ```
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "l2l2l2l2-l2l2-4l2l-l2l2-l2l2l2l2l2l2",
            "fk_list_id": "e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4",
            "name": "Write API Docs",
            "description": "Document all new API endpoints.",
            "position": 2,
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**PATCH /cards/{cardId}**
*   **Description:** Updates a single card.
*   **Sample Request:** `PATCH /api/cards/j9j9j9j9-j9j9-4j9j-j9j9-j9j9j9j9j9j9`
    ```json
    {
        "description": "Create high-fidelity mockups for the main dashboard, focusing on user experience."
    }
    ```
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "j9j9j9j9-j9j9-4j9j-j9j9-j9j9j9j9j9j9",
            "fk_list_id": "e4e4e4e4-e4e4-4e4e-e4e4-e4e4e4e4e4e4",
            "name": "Design UI Mockups",
            "description": "Create high-fidelity mockups for the main dashboard, focusing on user experience.",
            "position": 0,
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**DELETE /cards/{cardId}**
*   **Description:** Deletes a single card.
*   **Sample Request:** `DELETE /api/cards/j9j9j9j9-j9j9-4j9j-j9j9-j9j9j9j9j9j9`
*   **Sample Response:** `HTTP 200 OK`

---

## Label Resources

**GET /labels/{labelId}**
*   **Description:** Retrieves a single label.
*   **Sample Request:** `GET /api/labels/g6g6g6g6-g6g6-4g6g-g6g6-g6g6g6g6g6g6`
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "g6g6g6g6-g6g6-4g6g-g6g6-g6g6g6g6g6g6",
            "fk_board_id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
            "name": "Bug",
            "color": "#FF0000",
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**POST /labels**
*   **Description:** Creates a new label.
*   **Sample Request:** `POST /api/labels`
    ```json
    {
        "fk_board_id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
        "name": "Urgent",
        "color": "#FFA500"
    }
    ```
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "m3m3m3m3-m3m3-4m3m-m3m3-m3m3m3m3m3m3",
            "fk_board_id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
            "name": "Urgent",
            "color": "#FFA500",
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**PATCH /labels/{labelId}**
*   **Description:** Updates a single label.
*   **Sample Request:** `PATCH /api/labels/g6g6g6g6-g6g6-4g6g-g6g6-g6g6g6g6g6g6`
    ```json
    {
        "color": "#DC143C"
    }
    ```
*   **Sample Response:**
    ```json
    {
        "data": {
            "id": "g6g6g6g6-g6g6-4g6g-g6g6-g6g6g6g6g6g6",
            "fk_board_id": "b1b1b1b1-b1b1-4b1b-b1b1-b1b1b1b1b1b1",
            "name": "Bug",
            "color": "#DC143C",
            "created_at": "2021-01-01T00:00:00+00:00",
            "updated_at": "2021-01-01T00:00:00+00:00",
            "deleted_at": null
        }
    }
    ```

**DELETE /labels/{labelId}**
*   **Description:** Deletes a single label.
*   **Sample Request:** `DELETE /api/labels/g6g6g6g6-g6g6-4g6g-g6g6-g6g6g6g6g6g6`
*   **Sample Response:** `HTTP 200 OK`