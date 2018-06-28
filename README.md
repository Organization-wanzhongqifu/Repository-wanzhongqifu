### 地址说明
前台地址 [wanzhongqf.demo.chilunyc.com](http://wanzhongqf.demo.chilunyc.com)<br />
后台地址 [wanzhongqf.demo.chilunyc.com/admin](http://wanzhongqf.demo.chilunyc.com/admin)<br />
后台帐号:admin 后台密码:admin123
### 数据库配置
mysqlhost = wanzhongqf.demo.chilunyc.com<br />
mysqluser = wanzhong<br />
mysqldb = wanzhong<br />
mysqlpassword = AFrokRANYodgYqfdnCpHc4RV<br />
port = 6678<br />
### branch 说明
master branch 为开发 branch，工程师可以直接 push 到此 branch 中<br />
staging branch 为测试服务器 branch，做了 ci 集成，测试服务器会同步到此 branch 中<br />
#### 注意：不要直接 push 代码到 staging branch 中
### 合并 staging branch 流程 
#### step1
git checkout master<br />
git pull origin staging<br />
git push origin master<br />
#### step2
git checkout staging<br />
git pull origin staging<br />
git merge master<br />
git push origin staging<br />