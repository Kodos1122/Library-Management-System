# Library Management System
<img src="https://i.imgur.com/JPnZrUU.png" width="250" height="250">

### Team Members

- Tanner Little

- Muhmamad Hamza Zahid

- Denishan Savarimuthu

- Osamah Al-Bayati

## Functional and Non-Functional Requirements

### Functional requirements

- Users have a role designating their permissions to read and update the database. (e.x. guests, users, librarians, auditors, admins)
- Authorized users are able to update book information in the database.
- Authorized users are able to rent a book.
- The system will link the User and the Book together throughout the rental period.
- The system will time the period the book is rented.
- The system will update the status of the book (rented or available to rent).
- The system will display the current statistics for all books, rented books, and available books in the Database.


### Non-Functional requirements

- When a user updates the book database, the update is done in under 500ms.
- When the user rents a book, the system creates the order and executes it in under 1000ms. 
- The system double checks the status of the book as each order is executed.
- The system checks user authentication and authorization for all requests and updates.
- The current number of all books, rented books, available books is updated in real-time.
- The system is available 99.99% of the time, via the web application.


## Artifacts

### Use Case Models

| Use Case | Description |
| --- | --- |
| UC-1: Log In | A user logs into the system through a login/password screen. Upon successful login, the user is presented with different options according to their role (e.x. guests, users, librarians, auditors, admins). |
| UC-2: Manage Book Server | The roles with the authority adds, removes or modifies the book server. |
| UC-3: Display book status change | Book status changes are stored and displayed for particular roles with authority. These can be filtered by various criteria such as time since change. |
| UC-4: Detect Rental Period | Detects and notifies of out of date book rental. |
| UC-5: Manage Rentals | The roles with authority ends, extends or flags special case rental period. |
| UC-6: Collect Performance Data | Network performance data (delay, offset, and jitter) is collected periodically from the time servers. |
| UC-7: Collect System Modification Data  | Any changes in the system is collected for the past thirty days. |


### Quality Attributes associated with the use cases

| ID | Quality Attribute | Scenario | Associated Use Case |
| --- | --- | --- | --- |
| QA-1 | Performance | Book server sends trap 'out of date rental' at peak load. 100% of traps are correctly identified and successfully processed and stored. | UC-4 |
| QA-2 | Modifiability | A new book is added to book server. The book is added successfully without any changes to the other data stored in book server. | UC-2 |
| QA-3 | Availability | A failure occurs in the library management system during normal operation. The library management system resumes operation in less than 1 minute | All |
| QA-4 | Performance | User attempts to log in. The library management system process log-in in under 100ms | UC-1 |
| QA-5 | Performance | The library management system collects network performance data from a server during peak load. The library management system collects all performance data within 10 minutes, while processing all user requests, to ensure no loss of data due to CON-5 | UC-6 |
| QA-6 | Security | A user performs a change in the system durning normal operation. It is possible to know who performed the operation and when it was performed 100% of the time. | All |


### System Constraints associated with the use cases

| ID | Constraint |
| --- | --- |
| CON-1 | The system must be accessed through a web browser. |
| CON-2 | Active events must be stored until resolution. |
| CON-3 | Unactive events must be stored for 2 weeks. |
| CON-4 | The network connection to user workstations can have low bandwidth but is generally reliable. |
| CON-5 | Network data needs to be collected in set intervals of no more than 10 minutes, as higher intervals result in some data being lost. |
| CON-6 | Modification data can only be held for 30 days before being deleted, as there is not enough space to collect for longer. |


## ADD Iteration One

### Architectural Concerns:

| ID | Concern |
| --- | --- |
| CRN-1 | Establishing an overall initial system structure. |
| CRN-2 | Leverage the team's knowledge about the technologies. |
| CRN-3 | Allocate work to members of the team. |

### Step 1

| Category | Details |
| --- | --- |
| Design Purpose | This is a greenfield system from a mature domain. The purpose is to produce a sufficiently detailed design to support the construction of the system. |
| Primary Functional Requirements | From the use cases presented in Section 4.2.1, the primary ones were determined to be: <br /> UC-1: Because it directly supports the core business <br /> UC-2: Because it directly supports the core business <br /> UC-4: Because it directly supports the core business <br /> UC-6: Because of the technical issues associated with it (see QA-5) |
| Quality Attribute Scenarios | [Quality Attribute Scenarios](https://github.com/OsamahAl-Bayati/Library-Management-System-Project#quality-attribute-scenarios "Jump to Quality Attribute Scenarios") |
| Constraints | [Constraints](https://github.com/OsamahAl-Bayati/Library-Management-System-Project#system-constraints-associated-with-the-use-cases "Jump to Constraints") |
| Architectural concerns | [Architectural concerns](https://github.com/OsamahAl-Bayati/Library-Management-System-Project#architectural-concerns "Architectural concerns") |

#### Quality Attribute Scenarios

| Scenario ID | Importance to the Customer | Difficulty of Implementation According to the Architect |
| --- | --- | --- |
| QA-1 | low | high |
| QA-2 | medium | medium |
| QA-3 | high | high |
| QA-4 | high | medium |
| QA-5 | medium | high |
| QA-6 | medium | low |

### Step 2

* QA-3: Availability
* QA-4: Performance
* CON-1: System must be accessed through a web browser.
* CON-4: Network connection to users' workstations can have low bandwidth and be unreliable.
* CON-5: Network data needs to be collected in set intervals of no more than 10 minutes, as higher intervals result in some data being lost.
* CRN-2: Leverage team's knowledge about the technologies.

### Step 3

The entire system is refined since it is a greenfield development effort. Refinement is performed through decomposition.

### Step 4


