Feature: Test news index

Scenario: Index page should return list of news
When I'm on news index page
Then I should see products in json format

Scenario: Posting to page should add new news
When I post data for news
Then I should see that data is saved successful
