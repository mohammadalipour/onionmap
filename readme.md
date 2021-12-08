# Billie Project

As part of this project, I've created a boilerplate Clean Architecture (onion architecture)for the Symfony framework. 
it's powered by the latest version of PHP

![Clean Architecture](https://tech.ovoenergy.com/content/images/2018/12/OnionLayersLabelled-2.png)

The Onion Architecture relies heavily on the Dependency Inversion principle.  The application core needs implementation
of core interfaces, and if those implementing classes reside at the edges of the application, we need some mechanism for
injecting that code at runtime so the application can do something useful.

The database is not the center.  It is external.   Externalizing the database can be quite a change for some people
used to thinking about applications as “database applications”.  With Onion Architecture, there are no database
applications.  There are applications that might use a database as a storage service but only through some external
infrastructure code that implements an interface that makes sense to the application core.  Decoupling the application
from the database, file system, etc, lowers the cost of maintenance for the life of the application.


### Architecture<br>

#### Application Core (application + domain)

<li> <b>Application</b> :
Application layer manages the internal domain logic. It provides different application services, which enable the
communication with presentation, tests and infrastructure.<br>

<ul>
<li>
Events / Event Subscriber:
defines the events, which represent the state changes in business domain. for example:
</li>
<li>Services:
The ser services enable the interaction with internal domains by using the predefined interfaces in the domain layer.
</li>
<li>Query interface:
These interfaces are defined for fetching the domain data. They are commonly used by presentation layer and implemented 
by infrastructure layer.
</li>
<li>command :
They are simple objects, which are used to change the state of business domain. For example: confirmPayment
</li>
</ul>
</li>

<li> <b>Domain</b> :<br>
has no interaction direct with outer layer. It represents the domain business and domain logic. It defines always the 
domain specific entities, value objects, events, exceptions, services, factories, interfaces. <br>
<ul>
<li>Models : consist of entities, value objects, aggregates
</li>
<li>Repository interface :
interfaces to access the business models, which are used by application and implemented by outer layer. For example:
infrastructure
</li>
<li>Assertions : The business rules to adjust changes on business behavior and business models
services
</li>
<li>Domain services : define the complex internal communication among the domain models. For example:
apply some changes cross different domain models.
</li>
<li>Events:
which can be used to track the state changes of domain
</li>
</ul>
</li>

#### Presentation
It provides the interfaces how end user can drive the business logic
<ul>
<li> Controllers:
controllers are the typical gateways for interaction coming from end user. It can be a controller, that represents REST
endpoint; or a controller, that renders the web page.
consoles
</li>
<li>DTO:
Data Transfer Object, defines the view model of request and response
</li>
</ul>

#### Infrastructure
The infrastructure layer holds the most low level code. Anything in here should be easy to replace. Code here should 
never affect anything related to logic, or how your application behaves.
<li>Doctrine : Query implementations</li>
<li>Repository implementations</li>
<li>Filesystem</li>
<li>Queue</li>
<li>Cron-jobs</li>
<li>Logging</li>

#### Tests
Test layer test the functionality of application core and integration between application core and outer layer.
<li>Unit Tests : 
Test if internal application core works well
</li>
<li>Integration :
Test if the communication between application core and external services in infrastructure layer is possible
 </li>
<li>Functional :
Test if the interaction between end user and the presentation layer work well
</li>