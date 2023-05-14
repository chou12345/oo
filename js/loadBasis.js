
$(document).ready(async function () {

    const dropdownLists = {
        merchant: {
            title: "商家",
            list: [
                { title: "商家首頁", url: "merchant_index.php" },
                { title: "我的合約", url: "merchant_contract.php" },
            ]
        },
        general: {
            title: "個人",
            list: [
                { title: "個人資料", url: "user_information.php" },
                { title: "我的收藏", url: "user_heart.php" },
                { title: "我的追蹤", url: "user_follow.php" },
                { title: "我的合約", url: "user_contract.php" },
                { title: "我的發文", url: "user_post.php" },
            ]
        },
        manager: {
            title: "管理者",
            list: [
                { title: "管理員首頁", url: "manager_index.php" },
                { title: "我的合約", url: "manager_contract.php" },
                { title: "新增合約", url: "manager_contract_insert.php" },
            ]
        },
    }
    const sidebarLists = {
        merchant: [],
        general: [
            {
                title: "文章類別",
                list: [
                    { title: "選課", url: "" },
                    { title: "租屋", url: "" },
                ]
            },
            {
                title: "我的主頁",
                list: [
                    { title: "個人資料", url: "" },
                    { title: "我的收藏", url: "" },
                    { title: "我的追蹤", url: "" },
                    { title: "我的合約", url: "" },
                    { title: "我的貼文", url: "" },
                    { title: "我的錢包", url: "" },
                ]
            },
        ],
        manager: [
            {
                title: "審核",
                list: [
                    { title: "審核貼文", url: "report_post_view.php" },
                    { title: "審核留言", url: "report_reply_view.php" },
                ]
            },
            {
                title: "使用者帳號管理",
                list: [
                    { title: "停權帳號", url: "suspend_view.php" },
                ]
            },
            {
                title: "平台內容管理",
                list: [
                    { title: "文章類別", url: "article_category.php" },
                    { title: "文章內容", url: "article_view.php" },
                ]
            },
            {
                title: "合約內容管理",
                list: [
                    { title: "合約管理", url: "manager_contract_list.php" },
                ]
            },

        ],
    }
    var userInfo = await getUserInfo() || {};
    loadNavDropdown();
    loadSidebar();
    

    function loadNavDropdown() {
        if (!userInfo.identity || !dropdownLists[userInfo.identity]) {
            return;
        }
        const dropdownObj = dropdownLists[userInfo.identity];
        $("#nav_dropdown").append(`
            <i class="fas fa-user text-primary"></i>
            <span class="badge" margin="3px">${dropdownObj.title}</span>
            <i class="fas fa-caret-down text-primary"></i>
            <div class="dropdown-menu position-absolute bg-secondary">
                ${dropdownObj.list.map(ddo => `<a href="${ddo.url}" class="dropdown-item">${ddo.title}</a>`).join("")}
                <a href="log_out.php" class="dropdown-item">登出</a>
            </div>
        `);

    }

    async function loadSidebar() {
        if (!userInfo.identity || !sidebarLists[userInfo.identity]) {
            return;
        }
        if (userInfo.identity === 'merchant') {
            const [merchants, articles] = await Promise.all([
                $.ajax({
                    url: getAjaxUrl('merchant', 'getAllMerchants'),
                    dataType: 'JSON'
                }),
                $.ajax({
                    url: getAjaxUrl('dictionary', 'getAllArticles'),
                    dataType: 'JSON'
                })
            ])
            sidebarLists['merchant'] = [
                {
                    title: "文章類別",
                    list: articles.map(article => ({
                        title: article.dictionary_name,
                        url: ""
                    }))
                },
                {
                    title: "特約商店",
                    list: merchants.map(merchant => ({
                        title: merchant.name,
                        url: ""
                    }))

                }
            ]
        }
        const sidebarObj = sidebarLists[userInfo.identity];
        $("#navbar-vertical").append(`
            <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                ${sidebarObj.map(sbo => `
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown">${sbo.title}
                    <i class="fa fa-angle-down float-right mt-1"></i></a>
                    <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                        ${sbo.list.map(sb => `<a href="${sb.url}" class="dropdown-item">${sb.title}</a>`).join("")}    
                    
                    </div>
                </div>
                    `).join("")}
                
        `);
    }
})
