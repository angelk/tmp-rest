Feature: Test news index

Scenario: Index page should return list of news
When I'm on news index page
Then I should see products in json format
