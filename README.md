# pcss


## pcss是一个基于php的css语法糖脚本。
由于css的难维护性，国内外出现了一些维护css的工具，框架等等。
pcss的目的也是为了使css的维护更为简单。

## pcss的优点：

1. 拥有php脚本的所有功能
2. 能自动监控并且生成相应的css文件

## 如何安装pcss?
将php的运行路径添加到系统变量中，然后运行本目录下的install.bat。
而后，就可以使用pcss了(pcss 监控的目录 输出的目录)。

## 如何使用pcss?
在某个目录下，新建一个.pcss的文件。
然后便可在这个pcss中书写正常的css代码了。
然后使用pcss ./ ./test/，监控本目录，并且将pcss解析成css代码，输出到test目录下。

> 由于pcss是基于php的，因此需要您的计算机上已经安装好了php，并且将php的路径设置到系统的环境变量上。在安装前，测试电脑是是否安装并且正确设置了php路径，可以使用'php -v'，如果正确显示php的版本，说明php已经正确配置。

## 在pcss中，如何使用php代码？
将php代码以{:}包裹。如{:echo '123';}


> 安装前请以管理员身份运行。如果还是安装失败，则将bin目录设置到系统的环境变量即可。