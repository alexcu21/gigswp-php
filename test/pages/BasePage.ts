import { Page, Locator } from "@playwright/test";

class BasePage {
    readonly page: Page;
    readonly logo: Locator;
    readonly searchHeading: Locator;

    constructor(page: Page){
        this.page = page;

        //locators
        this.logo = page.getByText('GIGSWP');
        this.searchHeading = page.getByText('Find Your Dream Job');
    }


}

export default BasePage;