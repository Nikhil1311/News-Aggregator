import urllib.request
from urllib.request import Request, urlopen
from bs4 import BeautifulSoup
import re
import os
import sys

def get_url1(query):
    qarr = query.split()
    q = [x for x in qarr]
    query = "http://www.bbc.co.uk/search?q=" + '+'.join(q)
    # print ("this is sparta"+query)
    return query


def get_links1(query):
    search_url = get_url1(query)
    site = urllib.request.urlopen(search_url)
    data = site.read()
    the_links = []
    parsed = BeautifulSoup(data,"html.parser")
    header=[]
    for head in parsed.find_all('h1'):
        header.append(head.get_text())
        the_links.append(head.a['href'])
    # print(header)
    # for links in parsed.find_all('article', class_= 'has_image media-text'):
    # #for links in parsed.findAll('tag', {re.compile('p')}):
    #     the_links.append(links.a['href'])
    # print (the_links)
    return the_links, header


def file_write(qry,op, i):
    file = open(qry + ".txt", "a", encoding='utf-8')
    file.write(op)
    file.write('\n \n')
    file.close()


def get_data1(qry,u,t, i):
	print("getting data for " + qry)
	op = ""
	try:
		# print(u,t)
		theurl = Request(u, headers = {'User-agent' : 'Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5', 'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' })
		html=urllib.request.urlopen(theurl)
		data = html.read().decode('utf-8', 'ignore')
		soup=BeautifulSoup(data, 'html.parser')
		res = [i.text.replace('\n', ' ').strip() for i in soup.find_all('div', class_= 'story-body__inner')]
		# print(res)
		res = res[0]
		res = re.sub(re.compile('\/\*\*\/([^\*]|\*+[^\*\/])*\*+\/' ) ,"" ,res)
		op = op +  '<div class="w3-card col-md-8 col-md-offset-2"><h3 id="crawlidtitle" class="crawlclasstitle">' + t + '</h3>' + '<h5 id="sitenameid" class="sitenameclass">BBC</h5>'  + '\n' + '<p id="crawlidtext" class="crawlclasstext">'
		for p in res:
			op = op + p
		op = op + '</p></div>'
		file_write(qry,op, i)

	except Exception as e:
		print(e)


def get_queries1():
    try:
        f = open('query.txt', 'r')
        qs = f.readlines()
        f.close()
        qs = list(map(lambda s: s.strip(), qs))
        print(qs)
        return qs

    except IOError as e:
        print("\nPlease choose the correct path for query.txt! ")


def get_url(query):
    qarr = query.split()
    q = [x for x in qarr]
    query = "http://timesofindia.indiatimes.com/topic/" + '-'.join(q)
    # print ("this is sparta"+query)
    return query


def get_links(query):
    search_url = get_url(query)
    site = urllib.request.urlopen(search_url)
    data = site.read()
    the_links = []
    header=[]
    parsed = BeautifulSoup(data,"html.parser")
    i=0
    for head in parsed.find_all('span', class_='title'):
    	header.append(head.get_text())
    # print (header)
    for links in parsed.find_all('div', class_='content'):
    #for links in parsed.findAll('tag', {re.compile('p')}):
        the_links.append('http://timesofindia.indiatimes.com/'+links.a['href'])
    # print (the_links)
    return the_links, header



def get_data(qry,u,t,i):
	print("getting data for " + qry)
	op = ""
	try:
		# print (t)
		# print(u)
		theurl = Request(u, headers = {'User-agent' : 'Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5', 'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' })
		html=urllib.request.urlopen(theurl)
		data = html.read().decode('utf-8', 'ignore')
		soup=BeautifulSoup(data, 'html.parser')
		res = [i.text.replace('\n', ' ').strip() for i in soup.find_all('div', class_= 'Normal')]
		for p in res:
			op = op + '<div class="w3-card col-md-8 col-md-offset-2"><h3 id="crawlidtitle" class="crawlclasstitle">' +  str(t) + '</h3>'+ '<h5 id="sitenameid" class="sitenameclass">TOI</h5>'  + '\n' + '<p id="crawlidtext" class="crawlclasstext">' + p + '</p></div>' + '\n'
		file_write(qry,op, i)
	except Exception as e:
		print(e)


def get_queries():
    try:
        f = open('query.txt', 'r')
        qs = f.readlines()
        f.close()
        qs = list(map(lambda s: s.strip(), qs))
        print(qs)
        return qs

    except IOError as e:
        print("\nPlease choose the correct path for query.txt! ")



def main():
	l = open("query.txt", 'r')
	query = l.readlines()[0]
	# print(query)
	l.close()
	file = query + ".txt"
	for root, dirnames, filenames in os.walk("."):
		for filename in filenames:
			if(file.lower()==filename.lower()):
				# print("gg")
				sys.exit(0)
	url, titles = get_links(query)
	url1, titles1 = get_links1(query)
	#print (url)
	k=0
	for i in range(len(titles1)):
		if(i<len(url1)):
			if(k<8):
				get_data1(query, url1[i], titles1[i], i)
				k+=1

	for i in range(len(titles)):
		if(i<8):
			get_data(query, url[i+1], titles[i], i)


if __name__ == "__main__":main()