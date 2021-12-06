# Library Management System
<img src="https://i.imgur.com/JPnZrUU.png" width="250" height="250">

### Team Members

- Tanner Little

- Muhmamad Hamza Zahid

- Denishan Savarimuthu

- Osamah Al-Bayati

## How to Install and Execute on Windows, Mac, or Linux

#### System Requirements
- Apache >= 2.4
- MySQL >= 5.6
- PHP >= 8.1

#### Install and Execute

Clone the repository to your website root (usually public_html, or setup an Apache virtual host). Copy config.ini.sample to config.ini and populate it with your database connection details. Ensure Apache mod_rewrite is enabled to allow the .htaccess file to tell the server to allow direct access to files ending with specific extensions, and tell the server to redirect all requests to the routes file. Start the Apache and MySQL services.

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

## ADD Iteration Two

### Step 2

* UC-1: Log-In
* UC-2: Manage Book Server
* UC-3: Display Book Status Change
* UC-5: Manage Rentals

### Step 3

The modules located in the different layers.

### Step 4

| Design Decisions and Location | Rationale and Assumptions |
| --- | --- |
| Create a Domain Model for the application | It is necessary to create an initial domain model for the system, Before starting a functional decomposition, identifying the major entities in the domain, along with their relationships. There are no good alternatives. A domain model must eventually be created, or it will emerge in a suboptimal fashion. |
| Identify Domain Objects that map to functional requirements | Each distinct functional element of the application needs to be encapsulated in a self-contained building block-a domain object. One possible alternative is to not consider domain objects and instead directly decompose layers into modules, but this increases the risk of not considering a requirement. |

### Step 5

| Design Decisions and Location | Rationale |
| --- | --- |
| Create only an initial domain model | An initial domain model is diagrammed to identify primary participating entities in our use cases. As this is an initial design, only the primary use cases are represented. |
| Map the system use cases to domain objects | An initial identification of domain objects can be made by analyzing the system's use cases. To address CRN-2 and CRN-3 (leverage the team's knowledge about the technologies, and allocate work to members of the team), domain objects are identified for all of the use cases. |
| Decompose the domain objects across the layers to identify layer-specific modules with an explicit interface | Modules are identified and represented to support all of the functionalities in accordance with our primary use cases. These modules can then be unit-tested to ensure correct functionality and behaviour throughout the development process. CRN-4: modules shall be unit tested. |
| Connect components associated with modules using MVC | This project uses the Model-View-Controller framework for dependency between components associated with the predetermined modules to be structures, maintainable, and scalable. |
| Associate frameworks with a module in the data layer | ORM mapping is encapsulated in the modules that are contained in the data layer. |

### Step 6

<img src="https://i.imgur.com/ca4YZ1o.png">
Figure 1: Initial Domain Model

<img src="https://i.imgur.com/AD3Nqrf.jpg">
Figure 2: Domain Objects associated with use case model

<img src="https://i.imgur.com/0YmeagA.png">
Figure 3: Primary Use Case Supporting Modules

| Element | Responsibility |
| --- | --- |
| Page View | Displays the requested page in the web browser and is dynamically updated to reflect user interactions. The user interface elements and process are from the reference architecture. |
| Page Controller | Provides the necessary information from the request manager to display the current page view. Ensures proper encoding and formatting of the data to be displayed in the web browser. |
| Request Manager | Facilitates communication between the client and the server, passing user interaction events to the server and passing server responses to the page controller. |
| Request Service | Receives requests from the client-side to communicate with the server logic to provide additional information to the current view, or provide a new requested page view. |
| Router | Provides a connection to the correct model and view based on the client request. Handles interaction between HTTP methods (GET, POST, etc.) to provide the correct logic based on the request. |
| Domain Entities | Contains the entities from the domain model (server-side). |
| Controller| Communicates with the correct model and view and provides the correct data required by the model for the view. Connects to the database connector to interface with the database. |
| Database Connector | Provides a connection to the backend database to create, read, update, and delete data. |

### Step 7

| Not Addressed | Partially Addressed | Completely Addressed | Design Decision Made During Iteration |
| --- | --- | --- | --- |
| --- | --- | UC-1 | Modules across the layers and preliminary interfaces to support this use case have been identified. |
| --- | --- | UC-2 | Modules across the layers and preliminary interfaces to support this use case have been identified. |
| --- | --- | UC-3 | Modules across the layers and preliminary interfaces to support this use case have been identified. |
| --- | --- | UC-5 | Modules across the layers and preliminary interfaces to support this use case have been identified. |
| --- | QA-3 | --- | No relevant decision made |
| --- | QA-4 | --- | No relevant decision made |
| --- | CON-2 | --- | No relevant decision made |
| --- | CON-4 | --- | No relevant decision made |
| --- | CON-5 | --- | No relevant decision made |
| --- | CRN-2 | --- | Additional technologies were identified and selected considering the team's knowledge. |
| --- | --- | CRN-3 | Work assignment table used to address the allocation of work to the team members. |
| --- | CRN-4 | --- | Introduced in this iteration. It is partially solved by the use of an inversion of control approach to connect the components associated with the modules.|

## ADD Iteration Two

### Step 2

QA-3 (Availability): A failure occurs in the library management system during normal operation. The library management system resumes operation in less than 1 minute.

### Step 3

The elements that will be refined are the application server and the book database server.

### Step 4

| Design Decisions and Location | Rationale and Assumptions |
| --- | --- |
| Active redundancy: replicate the application server and other critical components such as the database. | By replicating the critical elements, the system can withstand the failure of one of the  replicated elements without affecting functionality. |
| Introduce the message queue technology family  | Traps received from time servers are placed in the message queue then taken by the application. |

### Step 5

| Design Decisions and Location | Rationale |
| --- | --- |
| Use active redundancy and load balancing in the application server | Since two replicas of the application server are active at any time, load is balanced among the replicas. New Concern (CRN-5) : Manage State in replicas. |
| Deploy message queues on a separate node | Guarantees that no traps are lost in the event of an application failure |
| Using Technology support, implement load balancing and redundancy. | Many technological options for load balancing and redundancy can be implemented without having to develop an ad hoc solution. |

### Step 6

| Element | Responsibility |
| --- | --- |
| LoadBalancer | Dispatches requests from clients to the library application server. |
| TrapReceiver | Receives trap from book manager server, converts them to events, and places the events into persistent message queue.  |
| CRN-3 | Allocate work to members of the team. |

<img src="https://i.imgur.com/lQZDLtc.jpg">
Figure 4: Deployment diagram

![Figure 5: Sequence diagram](img src="https://i.imgur.com/5Jzuqxt.png")
*Figure 5: Sequence diagram*

### Step 7

| Not Addressed | Partially Addressed | Completely Addressed | Design Decision Made During Iteration |
| --- | --- | --- | --- |
| --- | QA-3 | --- | A separate replicated trap receiver can ensure 100% of the traps are processed, even in  the case of a failure of the application server.  Furthermore,  because trap reception is performed in a separate node, thereby helping performance. No specific technologies have been chosen. |
| --- | QA-4 | --- | A redundant application server reduces the probability of system failure. Furthermore, if the load balancer fails, a passive replica is activated within the required time period. No specific technologies have been chosen. |
| --- | CON-4 | --- | No relevant decision made |
| --- | CON-5 | --- | No relevant decision made |
| --- | CRN-2 | --- | No relevant decision made |
| --- | CRN-4 | --- | No relevant decision made |
| CRN-5 | --- | --- | Introduced in this iteration, no decisions have been made. |


