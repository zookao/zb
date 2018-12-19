import requests,re

import sys,time,os

import json
import datetime

from multiprocessing import Pool

agent = 'Mozilla/5.0 (Windows NT 5.1; rv:33.0) Gecko/20100101 Firefox/33.0'
headers = {'User-Agent': agent}

preUrl = 'http://api.hclyz.cn:81/mf/'

def mkdir(path):
    path = path.strip()
    path = path.rstrip("\\")
    isExists = os.path.exists(path)

    if not isExists:
        os.makedirs(path)

dirPath = os.path.join(os.getcwd(),'zb1')
mkdir(dirPath)

def getAllPlants():
    allPlantsUrl = '{0}json.txt'.format(preUrl)
    allPlantsPage = requests.get(allPlantsUrl,headers=headers)
    if allPlantsPage.status_code == 200:
        if allPlantsPage.text:
            allPlantsContent = json.loads(allPlantsPage.text)
            if allPlantsContent['pingtai']:
                with open(os.path.join(dirPath,'json.txt'),'w') as f:
                    f.write(allPlantsPage.text.replace("\n", ""))
                p = Pool(10)
                for plant in allPlantsContent['pingtai']:
                    p.apply_async(handleOnePlant, args=(plant,))
                p.close()
                p.join()

def handleOnePlant(plant):
    onePlantAddressesUrl = '{0}{1}'.format(preUrl,plant['address'])
    onePlantAddressesPage = requests.get(onePlantAddressesUrl,headers=headers)
    if onePlantAddressesPage.status_code == 200:
        if onePlantAddressesPage.text:
            onePlantAllAddressContent = json.loads(onePlantAddressesPage.text)
            if onePlantAllAddressContent['zhubo']:
                with open(os.path.join(dirPath,plant['address']),'w') as ff:
                    ff.write(onePlantAddressesPage.text.replace("\n", ""))

if __name__ == '__main__':
    getAllPlants()