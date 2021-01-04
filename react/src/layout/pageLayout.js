import React, {useState} from 'react';
import '../App.css';
import { Layout, Avatar, Menu, Button, Breadcrumb, AutoComplete, Image, Anchor   } from 'antd';
import { Typography } from 'antd';
import { 
  Link } from 'react-router-dom';
import '../style/pageLayout.css';
import {
  AppstoreOutlined,
  MenuUnfoldOutlined,
  MenuFoldOutlined,
  PieChartOutlined,
  BellOutlined,
  InfoCircleOutlined,
  PictureFilled,
  UserOutlined,
  FileImageFilled,
  CloudUploadOutlined,
} from '@ant-design/icons';

const { Header, Footer, Sider, Content } = Layout;
const { Title } = Typography;
const { SubMenu } = Menu;
// const { Link } = Anchor;

export default function PageLayout(props) {
  
  const [collapsed, setCollapsed] = useState(false);
  const toggleCollapsed = () => {
      setCollapsed(!collapsed);
      console.log("Now state: " + collapsed);
  };

  
  // const [count, setCount] = useState(0);

  // const addCount = ()=>{
  //   setCount(count+1);
  // };

  return (
    
    <div className="App" >
      
      <Layout>
        <Sider className="menuSider" collapsible collapsed={collapsed}>
          
          
            <Menu
                defaultSelectedKeys={['1']}
                defaultOpenKeys={['sub1']}
                mode="inline"
                theme="dark"
                inlineCollapsed={collapsed}
            >
              
                <Menu.Item className="menuHeader">
                  {/* <Anchor> */}
                    
                    
                    
                    <Link to="/login"><Avatar className="menuHeaderPic" src="/img/ecoandgreen.jpg"/>
                      Eco&Green
                    </Link>
                  {/* </Anchor> */}
                </Menu.Item>
              
              
              <Menu.Item key="dashboard" icon={<PieChartOutlined />}><Link to="/dashboard"> Dashboard </Link></Menu.Item>
              
              
                <Menu.Item icon={<AppstoreOutlined />} key="event"><Link to="/event"> Event</Link></Menu.Item>
              
              
                <Menu.Item key="pushNotification" icon={<BellOutlined />}><Link to="/pushNotification"> Push Notification</Link></Menu.Item>
              
              <SubMenu key="uploads" icon={<CloudUploadOutlined />} title="Uploads">
                
                  <Menu.Item className="subLink" key="aboutUs" icon={<InfoCircleOutlined />}><Link  to="/aboutUs"> About Us</Link></Menu.Item>
                
                
                  <Menu.Item className="subLink" key="banner" icon={<PictureFilled />}><Link  to="/banner"> Banner</Link></Menu.Item>
                
                
                  <Menu.Item className="subLink" key="brandImage" icon={<PictureFilled />}><Link  to="/brand"> Brand Images</Link></Menu.Item>
                
                
                  <Menu.Item className="subLink" key="giftImage" icon={<FileImageFilled />}><Link  to="/gift"> Gift Images</Link></Menu.Item>
                
                
                  <Menu.Item className="subLink" key="promotionBanner" icon={<PictureFilled />}><Link  to="/promotion"> Promotion Banner</Link></Menu.Item>
                
                
              </SubMenu>
              <Menu.Item className="subLink" key="testing">
                <Link to="/test">
                  Testing Page
                </Link>
              </Menu.Item>
              
                <Menu.Item key="11" icon={<UserOutlined />}><Link to="/redemption"> Redemption Manager</Link></Menu.Item>
              
            </Menu>
            {/* <Switch>
              <Route path="/login" />
              <Route exact path="/hello" />
            </Switch> */}
          
        </Sider>
        
        <Layout className="site-layout">
          <Header  style={{ background: "orange", paddingLeft:"5px"}}>
            {React.createElement(collapsed ? MenuUnfoldOutlined : MenuFoldOutlined, {
                className: 'trigger siderButton',
                onClick: toggleCollapsed,
                
            })}
            
            <span className='profileUserName'><b>{props.userName}</b></span>
            <Avatar className='profilePic' size="large" icon="user" />
          </Header>
          <Layout style={{ padding: '0 24px 24px' }}>
            <Breadcrumb style={{ margin: '16px 0' }}>
                <Breadcrumb.Item>{props.pageName}</Breadcrumb.Item>
                <Breadcrumb.Item className="navigationState">Home</Breadcrumb.Item>
            </Breadcrumb>
            
            <Content
                id={props.id}
                className="site-layout-background"
                style={{
                    padding: 24,
                    margin: 0,
                    
                }}
                >
                {props.children}
            </Content>

          </Layout>
                 
          <Footer className="footer">Eco & Green Exhibition ©2020 All Rights Reserved.</Footer>
          
        </Layout>
        
          
      </Layout>
      
    </div>
    
  );
}
